<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Property;
use App\Models\City;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class CreateProperty extends Component
{
    use WithFileUploads;
   // Fields for step 1 
    public $property_title, 
           $slug, 
           $description, 
           $owner_document_type, 
           $current_status, 
           $listing_type, 
           $property_address, 
           $city_id,
           $location,
           $price_in, 
           $price,
           $user_id,
           $property_type;
    // Fields for step 2 (dynamic fields as per selected property type)
    // If property type is Plot, then these fields will be used
    public $plot_category, 
           $measurement_unit, 
           $plot_type, 
           $plot_number,
           $plot_front, 
           $plot_side_1, 
           $plot_side_2, 
           $plot_back, 
           $plot_size, 
           $price_per_sqft;
    // If property type is House, Flat, Apartment or Villa, then these fields will be used
    public $floor_number, 
           $bedrooms, 
           $bathrooms, 
           $balconies, 
           $total_floors, 
           $furnishing_status;
    // If property type is Office, then these fields will be used
    public $office_floor, 
           $office_bathrooms, 
           $office_balconies,
           $office_area_size_unit, 
           $office_area_size, 
           $office_furnishing_status;
    // If property type is Shop, then these fields will be used
    public $shop_type, 
           $shop_area_size_unit, 
           $shop_front, 
           $shop_side_1, 
           $shop_side_2, 
           $shop_back, 
           $shop_area_size, 
           $shop_floor, 
           $shop_with_water_connection;
    // If property type is Agriculture Land, then these fields will be used
    public $land_type, 
           $land_area_size_unit, 
           $land_area_size, 
           $current_status_of_land;
    // Fields for step 3
    public $latitude, 
           $longitude, 
           $negotiable_price = false,
           $market_price,
           $hospital_distance,
           $railway_distance,
           $transport_distance,
           $image,
           $area,
           $area_unit,
           $facing,
           $video_link,
           $court_case, 
           $court_case_details;
    public $status = 'active';

    // Mount Variables
    public $cities, $property_types, $listing_types, $plot_categories, $furnishing_statuses, $directions, $prices_in;
    
    public function mount()
    {
        $this->cities = City::orderBy('name')->get();
        $this->property_types = [
            'Plot', 'House', 'Flat', 'Apartment', 'Villa', 'Office', 'Shop', 'Agriculture Land'
        ];
        $this->listing_types = [
            'Sale', 'Rent', 'Lease'
        ];
        $this->plot_categories = [
            'Residential', 'Commercial', 'Industrial'
        ];
        $this->furnishing_statuses = [
            'Furnished', 'Semi-Furnished', 'Unfurnished'
        ];
        $this->directions = [
            'North', 'North-East', 'North-West', 'South', 'Soth-East', 'South-West', 'East', 'West'
        ];

        $this->prices_in = [
            'Lakh', 'Crore', 'Thousand', 'Millon', 'Billon', 'Trillion'
        ];
    }


    public function render()
    {
        return view('livewire.create-property');
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'property_title') {
            $this->slug = $this->generateUniqueSlug($this->property_title);
        }

        if (in_array($propertyName, ['plot_front', 'plot_back', 'plot_side_1', 'plot_side_2'])) {
            $this->calculatePlotSize();
        }

        if (in_array($propertyName, ['shop_front', 'shop_back', 'shop_side_1', 'shop_side_2'])) {
            $this->calculateShopArea();
        }
    }

    public function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $exists = Property::where('slug', $slug)->exists();

        if ($exists) {
            $slug .= '-' . rand(1000, 9999);
        }

        return $slug;
    }

    public function calculatePlotSize()
    {
        if ($this->plot_front && $this->plot_back && $this->plot_side_1 && $this->plot_side_2) {
            $avgWidth = ($this->plot_front + $this->plot_back) / 2;
            $avgDepth = ($this->plot_side_1 + $this->plot_side_2) / 2;
            $this->plot_size = round($avgWidth * $avgDepth, 2);
        }
    }

    public function calculateShopArea()
    {
        if ($this->shop_front && $this->shop_back && $this->shop_side_1 && $this->shop_side_2) {
            $avgWidth = ($this->shop_front + $this->shop_back) / 2;
            $avgDepth = ($this->shop_side_1 + $this->shop_side_2) / 2;
            $this->shop_area_size = round($avgWidth * $avgDepth, 2);
        }
    }

    public function createProperty()
    {
        $data = $this->validate([
                'property_title' => 'required|string|max:255',
                'description' => 'nullable|string|max:1000',
                'owner_document_type' => 'nullable',
                'current_status' => 'required',
                'listing_type' => 'required',
                'property_address' => 'required|string|max:255',
                'city_id' => 'required|exists:cities,id',
                'location' => 'required|string|max:255',
                'price_in' => 'required',
                'price' => 'required|numeric',
                'property_type' => 'required',
                'latitude' => 'nullable|numeric',
                'longitude' => 'nullable|numeric',
                'negotiable_price' => 'nullable',
                'market_price' => 'nullable|numeric',
                'hospital_distance' => 'nullable|string|max:100',
                'railway_distance' => 'nullable|string|max:100',
                'transport_distance' => 'nullable|string|max:100',
                'image' => 'nullable|image|max:5120|mimes:jpeg,png,jpg,gif,svg',
                'area_unit' => 'nullable',
                'area' => 'required|string|max:255',
                'facing' => 'nullable',
                'video_link' => 'nullable|url|max:255',
                'court_case' => 'required',
                'court_case_details' => 'nullable|string|max:255',
        ]);
        if ($this->property_type === 'Plot') {
            $this->validate([
                'plot_category' => 'required',
                'plot_type' => 'required',
                'plot_number' => 'nullable|string|max:255',
                'plot_front' => 'nullable|numeric',
                'plot_back' => 'nullable|numeric',
                'plot_side_1' => 'nullable|numeric',
                'plot_side_2' => 'nullable|numeric',
                'plot_size' => 'nullable|numeric',
                'price_per_sqft' => 'nullable|numeric',
            ]);
        }
        if (in_array($this->property_type, ['House', 'Flat', 'Apartment', 'Villa'])) {
            $this->validate([
                'floor_number' => 'nullable|string|max:255',
                'bedrooms' => 'required|integer|min:1',
                'bathrooms' => 'nullable|integer|min:1',
                'balconies' => 'nullable|integer|min:0',
                'total_floors' => 'nullable|integer|min:1',
                'furnishing_status' => 'required',
            ]);
        }

        if ($this->property_type === 'Office') {
            $this->validate([
                'office_floor' => 'nullable|integer|min:1',
                'office_bathrooms' => 'nullable|integer|min:0',
                'office_balconies' => 'nullable|integer|min:0',
                'office_area_size_unit' => 'nullable',
                'office_area_size' => 'nullable|numeric',
                'office_furnishing_status' => 'required',
            ]);
        }

        if ($this->property_type === 'Shop') {
            $this->validate([
                'shop_type' => 'required',
                'shop_front' => 'nullable|numeric',
                'shop_back' => 'nullable|numeric',
                'shop_side_1' => 'nullable|numeric',
                'shop_side_2' => 'nullable|numeric',
                'shop_area_size' => 'nullable|numeric',
                'shop_floor' => 'nullable|integer|min:1',
                'shop_with_water_connection' => 'required',
            ]);
        }

        if ($this->property_type === 'Agriculture Land') {
            $this->validate([
                'land_type' => 'required',
                'land_area_size_unit' => 'required',
                'current_status_of_land' => 'required',
                'land_area_size' => 'required|numeric',
            ]);
        }

        $imagePath = $this->image ? $this->image->store('properties', 'public') : null;
        if ($this->latitude === null || $this->longitude === null) {
            $city = City::find($this->city_id);
            if ($city) {
                $this->latitude = $city->city_latitude ?? 0.0; // Default value if not provided
                $this->longitude = $city->city_longitude ?? 0.0; // Default value if not provided
            }
        }
        // Create the property
        Property::create([
            'user_id' => auth()->id(),
            'property_title' => $this->property_title,
            'slug' => $this->slug,
            'owner_document_type' => $this->owner_document_type,
            'property_address' => $this->property_address,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'court_case' => $this->court_case,
            'court_case_details' => $this->court_case_details,
            'current_status' => $this->current_status,
            'listing_type' => $this->listing_type,
            'property_type' => $this->property_type,
            'video_link' => $this->video_link,
            
            'plot_category' => $this->plot_category,
            'measurement_unit' => 'Sq. Feet',
            'plot_type' => $this->plot_type,
            'plot_number' => $this->plot_number,
            'plot_front' => $this->plot_front,
            'plot_back' => $this->plot_back,
            'plot_side_1' => $this->plot_side_1,
            'plot_side_2' => $this->plot_side_2,
            'plot_size' => $this->plot_size,
            'price_per_sqft' => $this->price_per_sqft,
            'floor_number' => $this->floor_number,
            'bedrooms' => $this->bedrooms,
            'bathrooms' => $this->bathrooms,
            'balconies' => $this->balconies,
            'total_floors' => $this->total_floors,
            'furnishing_status' => $this->furnishing_status,
            'office_floor' => $this->office_floor,
            'office_bathrooms' => $this->office_bathrooms,
            'office_balconies' => $this->office_balconies,
            'office_area_size_unit' => $this->office_area_size_unit,
            'office_area_size' => $this->office_area_size,
            'office_furnishing_status' => $this->office_furnishing_status,
            'shop_type' => $this->shop_type,
            'shop_area_size_unit' => 'Sq. Feet',
            'shop_front' => $this->shop_front,
            'shop_back' => $this->shop_back,
            'shop_side_1' => $this->shop_side_1,
            'shop_side_2' => $this->shop_side_2,
            'shop_area_size' => $this->shop_area_size,
            'shop_floor' => $this->shop_floor,
            'shop_with_water_connection' => $this->shop_with_water_connection,
            'land_type' => $this->land_type,
            'land_area_size_unit' => $this->land_area_size_unit,
            'land_area_size' => $this->land_area_size,
            'current_status_of_land' => $this->current_status_of_land,

            'city_id' => $this->city_id,
            'location' => $this->location,
            'price_in_unit' => $this->price_in,
            'price' => $this->price,
            'negotiable_price' => $this->negotiable_price,
            'market_price' => $this->market_price,
            'facing' => $this->facing,
            'area_unit' => $this->area_unit,
            'area' => $this->area,
            'hospital_distance' => $this->hospital_distance,
            'railway_distance' => $this->railway_distance,
            'transport_distance' => $this->transport_distance,
            'image' => $imagePath,
            'description' => $this->description,
            ]);

        session()->flash('success', 'Property added successfully!');
        return redirect()->route('properties.index');

    }
}