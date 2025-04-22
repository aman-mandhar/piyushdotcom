<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BusinessDirectory;
use App\Models\Call;
use App\Models\City;
use App\Models\User;
use App\Models\CallProgress;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class DirectoryController extends Controller
{
    public function index()
    {
        $directories = BusinessDirectory::with('city')->latest()->paginate(10);
        $cities = City::all();
        return view('directory.index', compact('directories', 'cities'));
    }
    public function show(BusinessDirectory $directory)
    {
        return view('directory.show', compact('directory'));
    }
    public function search(Request $request)
    {
        $query = BusinessDirectory::query();

        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }
        if ($request->filled('business_type')) {
            $query->where('business_type', $request->business_type);
        }
        if ($request->filled('mobile')) {
            $query->where('mobile', 'like', '%' . $request->mobile . '%');
        }
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }
        if ($request->filled('video_link')) {
            $query->where('video_link', 'like', '%' . $request->video_link . '%');
        }
        if ($request->filled('address')) {
            $query->where('address', 'like', '%' . $request->address . '%');
        }
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        

        // Load related city data to prevent N+1 problem
        $directories = $query->with('city')->latest()->paginate(10);

        return view('directory.search', compact('directories'));
    }

    public function create()
    {
        if (!auth()->check()) {
            return redirect('/login')->with('error', 'Please login to post a vehicle.');
        }
        $cities = City::all();
        return view('directory.create', compact('cities'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city_id' => 'required|exists:cities,id',
            'mobile' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'business_type' => 'required|string|max:255',
            'video_link' => 'nullable|url|max:255',
        ]);

        $directory = new BusinessDirectory();
        $directory->name = $request->name;
        $directory->address = $request->address;
        $directory->city_id = $request->city_id;
        $directory->mobile = $request->mobile;
        $directory->email = $request->email;
        $directory->business_type = $request->business_type;
        $directory->video_link = $request->video_link;
        $directory->user_id = Auth::id();
        $directory->save();

        return redirect()->route('directory.index')->with('success', 'Business Directory created successfully.');
    }
    public function edit($id)
    {
        return view('directory.edit', ['id' => $id]);
    }
    public function update(Request $request, BusinessDirectory $directory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city_id' => 'required|exists:cities,id',
            'mobile' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'business_type' => 'required|string|max:255',
            'video_link' => 'nullable|url|max:255',
        ]);

        $directory->name = $request->name;
        $directory->address = $request->address;
        $directory->city_id = $request->city_id;
        $directory->mobile = $request->mobile;
        $directory->email = $request->email;
        $directory->business_type = $request->business_type;
        $directory->video_link = $request->video_link;
        $directory->save();

        return redirect()->route('directory.index')->with('success', 'Business Directory updated successfully.');
    }
    public function destroy(BusinessDirectory $directory)
    {
        $directory->delete();
        return redirect()->route('directory.index')->with('success', 'Business Directory deleted successfully.');
    }
    public function myDirectories()
    {
            $directories = BusinessDirectory::where('user_id', Auth::id())->latest()->paginate(10);
            $cities = City::all();
            return view('directory.my_directories', compact('directories', 'cities'));
    }

    public function showAll($id)
    {
        $callProgress = CallProgress::where('call_id', $id)->first(); // Use first(), not firstOrFail()
    
        if ($callProgress) {
            return redirect()->back()->with('error', 'Call has already been made.');
        }
    
        // Forget session call
        $call = session('call', []);
        // Get New call
        $call = Call::where('id', $id)->firstOrFail();
        // Put call in session
        session(['call' => $call]);
        $directory = BusinessDirectory::where('id', $call->directory_id)->firstOrFail(); // Correct foreign key
    
        return view('directory.show-all', compact('call', 'directory'));
    }
}
