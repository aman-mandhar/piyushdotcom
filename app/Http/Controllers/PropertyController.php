<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Property;
use App\Models\City;
use App\Models\Call;
use App\Models\CallProgress;
use App\Models\User;

class PropertyController extends Controller
{
    /**
     * Show all public properties (for search/buyers)
     */
    public function myProperties()
    {
        $properties = Property::with('city', 'user')
                    ->where('user_id', Auth::id())
                    ->latest()->paginate(10);
        $cities = City::all();
        return view('properties.my-properties', compact('properties', 'cities'));
    }

    /**
     * Show single property (public detail page)
     */
    public function show(Property $property)
    {
        $property = Property::with(['city', 'user'])->where('slug', $property->slug)->firstOrFail();
        return view('properties.show', compact('property'));
    }

    public function view(Property $property)
    {
        $property = Property::with(['city', 'user'])->where('slug', $property->slug)->firstOrFail();
        return view('view', compact('property'));
    }

    /**
     * Show all properties (public detail page)
     */
    public function showAll($id)
    {
        $callProgress = CallProgress::where('call_id', $id)->first(); // ✅ use `first()`, not `firstOrFail()`

        if ($callProgress) {
            return redirect()->back()->with('error', 'Call has already been made.');
        }

        // Forget session call
        $call = session('call', []);
        // Get New call
        $call = Call::where('id', $id)->firstOrFail();
        // Put call in session
        session(['call' => $call]);
        $property = Property::with(['city', 'user'])->where('id', $call->property_id)->firstOrFail();

        return view('properties.show-all', compact('call', 'property'));
    }

    /**
     * Public search (filtered property list)
     */
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

        return view('properties.search', compact('properties'));
    }


    /**
     * Show customer's own posted properties
     */
    public function index()
    {
        $properties = Property::all();
        return view('properties.index', compact('properties'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('properties.create'); // <- This Blade view will call the Livewire component
    }

    /**
     * Store new property
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'city_id' => 'required|exists:cities,id',
            'area' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'price' => 'nullable|numeric',
            'property_type' => 'required|string',
            'listing_type' => 'required|string',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'balconies' => 'nullable|integer|min:0',
            'hospital_distance' => 'nullable|string|max:50',
            'railway_distance' => 'nullable|string|max:50',
            'transport_distance' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('properties', 'public');
        }

        $data['user_id'] = Auth::id();
        $data['slug'] = Str::slug($data['title'] . '-' . uniqid());

        Property::create($data);

        return redirect()->route('properties.index')->with('success', 'Property posted successfully!');
    }

    /**
     * Edit property (only by owner)
     */
    public function edit(Property $property)
    {
        // Authorization check (optional)
        abort_unless(auth()->id() === $property->user_id, 403);
    
        return view('properties.edit', compact('property'));
    }

    /**
     * Update property
     */
    public function update(Request $request, Property $property)
    {
        if ($property->user_id !== Auth::id()) {
            abort(403);
        }

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'city_id' => 'required|exists:cities,id',
            'area' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'price' => 'nullable|numeric',
            'property_type' => 'required|string',
            'listing_type' => 'required|string',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'balconies' => 'nullable|integer|min:0',
            'hospital_distance' => 'nullable|string|max:50',
            'railway_distance' => 'nullable|string|max:50',
            'transport_distance' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('properties', 'public');
        }

        $property->update($data);

        return redirect()->route('properties.index')->with('success', 'Property updated successfully!');
    }

    /**
     * Delete property (only by owner)
     */
    public function destroy(Property $property)
    {
        if ($property->user_id !== Auth::id()) {
            abort(403);
        }

        $property->delete();

        return redirect()->route('properties.index')->with('success', 'Property deleted.');
    }

    
}
