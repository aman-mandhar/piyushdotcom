<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



class HomeController extends Controller
{
    public function index()
    {
        $properties = DB::table('properties')
            ->join('cities', 'properties.city_id', '=', 'cities.id')
            ->select(
                'properties.*', 
                'cities.name as city',
                'cities.city_latitude',
                'cities.city_longitude',
                'cities.state',
                'cities.state_latitude',
                'cities.state_longitude',
                'cities.country',
                'cities.country_latitude',
                'cities.country_longitude',
                'cities.pincode'
            )
            ->where('properties.status', 'active')
            ->get();

        $cities = City::all();
        $cur_user = Auth::check() ? Auth::user() : null;
        if ($cur_user == null) {
            $user = null;
            $default_latitude = 20.5937;
            $default_longitude = 78.9629;
        } else {
            $user = User::where('id', $cur_user->id)->first()->load('city');
            $default_latitude = $user->city->country_latitude; 
            $default_longitude = $user->city->country_longitude;
        }
        $allProperties = Property::with('city')
                    ->where('status', 'active')
                    ->with('city',
                            'user',
                            'listingType',
                            'propertyType',
                            'plot',
                            'apartment',
                            'house',
                            'villa',
                            'office',
                            'shop',
                            'agricultureLand',
                            'industrialLand',)
                    ->latest()
                    ->get();
        
        

        return view('home', compact('properties', 'cities', 'user', 'default_latitude', 'default_longitude', 'allProperties'));
    }   
      

    public function search(Request $request)
    {
        $query = Property::query();

        if ($request->filled('keyword')) {
            $query->where('title', 'like', '%' . $request->keyword . '%');
        }

        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        if ($request->filled('property_type')) {
            $query->where('property_type', $request->property_type);
        }

        // Load related city data to prevent N+1 problem
        $properties = $query->with('city')->latest()->paginate(10);

        return view('search', compact('properties'));
    }
    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }
    public function terms()
    {
        return view('terms');
    }
}


