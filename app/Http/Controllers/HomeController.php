<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\City;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index()
    {
        $properties = Property::whereNotNull('latitude')->whereNotNull('longitude')->with('city')->get();
        $cities = City::all();
        return view('home', compact('properties', 'cities'));
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


