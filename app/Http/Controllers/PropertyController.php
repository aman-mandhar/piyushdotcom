<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Property;
use App\Models\City;

class PropertyController extends Controller
{
    /**
     * Show all public properties (for search/buyers)
     */
    public function indexAll()
    {
        $properties = Property::with('city')->latest()->paginate(10);
        $cities = City::all();
        $propertyTypes = ['Residential Plot', 'House', 'Apartment', 'Villa', 'Office', 'Shop', 'Commercial Plot', 'Industrial Land', 'Agriculture Land'];
        $listingTypes = ['Sale', 'Rent', 'Lease', 'Collaborate'];
        return view('properties.indexall', compact('properties', 'cities', 'propertyTypes', 'listingTypes'));
    }

    /**
     * Show single property (public detail page)
     */
    public function show(Property $property)
    {
        return view('properties.show', compact('property'));
    }

    /**
     * Public search (filtered property list)
     */
    public function search(Request $request)
    {
        $query = Property::query();

        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        if ($request->filled('property_type')) {
            $query->where('property_type', $request->property_type);
        }

        if ($request->filled('listing_type')) {
            $query->where('listing_type', $request->listing_type);
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $properties = $query->latest()->paginate(10);
        return view('properties.indexall', compact('properties'));
    }

    /**
     * Show customer's own posted properties
     */
    public function indexCustomer()
    {
        $properties = Property::where('user_id', Auth::id())->latest()->paginate(10);
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

        return redirect()->route('customer.properties.index')->with('success', 'Property posted successfully!');
    }

    /**
     * Edit property (only by owner)
     */
    public function edit(Property $property)
    {
        if ($property->user_id !== Auth::id()) {
            abort(403);
        }

        $cities = City::all();
        $propertyTypes = ['Residential Plot', 'House', 'Apartment', 'Villa', 'Office', 'Shop', 'Commercial Plot', 'Industrial Land', 'Agriculture Land'];
        $listingTypes = ['Sale', 'Rent', 'Lease', 'Collaborate'];

        return view('properties.edit', compact('property', 'cities', 'propertyTypes', 'listingTypes'));
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

        return redirect()->route('customer.properties.index')->with('success', 'Property updated successfully!');
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

        return redirect()->route('customer.properties.index')->with('success', 'Property deleted.');
    }
}
