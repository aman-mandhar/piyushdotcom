<?php

namespace App\Livewire;

use App\Models\{
    Property, ListingType, PropertyType, Plot, House, Apartment, Villa, Office, Shop,
    AgricultureLand, IndustrialLand, City
};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class SellProperty extends Component
{
    public $step = 1;

    // Step 1
    public $listing_type_id, $property_type_id;

    // Step 2: Conditional fields (ALL property-type-specific)
    public $plot = [], $house = [], $apartment = [], $villa = [], $office = [], $shop = [],  $agriculture = [], $industrial = [];
    // Step 3: Mandatory fields of properties
    public $property_title, $slug, $description, $owner_document_type, $current_status;
    public $property_address, $location, $price_in, $price, $city_id;

    // Step 4: Optional fields
    public $latitude, $longitude, $hospital_distance, $railway_distance, $transport_distance;
    public $image, $bedrooms, $bathrooms, $balconies, $total_floors, $furnishing_status;
    public $video_link, $court_case = 'No', $court_case_details;

    public $property_id;

    use WithFileUploads;

    public function render()
    {
        return view('livewire.sell-property', [
            'listingTypes' => ListingType::all(),
            'propertyTypes' => PropertyType::all(),
            'cities' => City::all(),
        ]);
    }

    public function getPercentProperty()
    {
        return match ($this->step) {
            1 => 25,
            2 => 50,
            3 => 75,
            4 => 100,
            default => 0
        };
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'property_title') {
            $this->slug = $this->generateUniqueSlug($this->property_title);
        }

        if (in_array($propertyName, [
            'plot.plot_front', 'plot.plot_back', 'plot.plot_side_1', 'plot.plot_side_2'
        ])) {
            $this->calculatePlotSize();
        }

        if (in_array($propertyName, [
            'shop.shop_front', 'shop.shop_back', 'shop.shop_side_1', 'shop.shop_side_2'
        ])) {
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
        $front = $this->plot['plot_front'] ?? 0;
        $back = $this->plot['plot_back'] ?? 0;
        $side1 = $this->plot['plot_side_1'] ?? 0;
        $side2 = $this->plot['plot_side_2'] ?? 0;

        if ($front && $back && $side1 && $side2) {
            $avgWidth = ($front + $back) / 2;
            $avgDepth = ($side1 + $side2) / 2;
            $this->plot['plot_size'] = round($avgWidth * $avgDepth, 2);
        }
    }

    public function calculateShopArea()
    {
        $front = $this->shop['shop_front'] ?? 0;
        $back = $this->shop['shop_back'] ?? 0;
        $side1 = $this->shop['shop_side_1'] ?? 0;
        $side2 = $this->shop['shop_side_2'] ?? 0;

        if ($front && $back && $side1 && $side2) {
            $avgWidth = ($front + $back) / 2;
            $avgDepth = ($side1 + $side2) / 2;
            $this->shop['shop_area_size'] = round($avgWidth * $avgDepth, 2);
        }
    }

    public function nextStep()
    {
        if ($this->step === 1) {
            $this->validate([
                'listing_type_id' => 'required|exists:listing_types,id',
                'property_type_id' => 'required|exists:property_types,id',
            ]);
        }

        if ($this->step === 2) {
            $this->validatePropertyTypeFields();
        }

        if ($this->step === 3) {
            $this->validate([
                'property_title' => 'required|string|max:255',
                'owner_document_type' => 'required',
                'current_status' => 'required',
                'property_address' => 'required|string',
                'location' => 'required|string',
                'price_in' => 'required',
                'price' => 'required|numeric|min:0',
                'city_id' => 'required|exists:cities,id',
            ]);

            $foreignKeyColumn = null;
            $foreignKeyId = null;

            // Save appropriate property-type-specific record
            switch ($this->property_type_id) {
                case 1:
                    $foreignKeyColumn = 'plot_id';
                    $foreignKeyId = Plot::create($this->plot)->id;
                    break;
                case 2:
                    $foreignKeyColumn = 'house_id';
                    $foreignKeyId = House::create($this->house)->id;
                    break;
                case 3:
                    $foreignKeyColumn = 'apartment_id';
                    $foreignKeyId = Apartment::create($this->apartment)->id;
                    break;
                case 4:
                    $foreignKeyColumn = 'villa_id';
                    $foreignKeyId = Villa::create($this->villa)->id;
                    break;
                case 5:
                    $foreignKeyColumn = 'office_id';
                    $foreignKeyId = Office::create($this->office)->id;
                    break;
                case 6:
                    $foreignKeyColumn = 'shop_id';
                    $foreignKeyId = Shop::create($this->shop)->id;
                    break;
                case 7:
                    $foreignKeyColumn = 'agriculture_land_id';
                    $foreignKeyId = AgricultureLand::create($this->agriculture)->id;
                    break;
                case 8:
                    $foreignKeyColumn = 'industrial_land_id';
                    $foreignKeyId = IndustrialLand::create($this->industrial)->id;
                    break;
            }

            $imagePath = $this->image ? $this->image->store('properties', 'public') : null;
            if ($this->latitude === null || $this->longitude === null) {
                $city = City::find($this->city_id);
                if ($city) {
                    $this->latitude = $city->city_latitude ?? 0.0; // Default value if not provided
                    $this->longitude = $city->city_longitude ?? 0.0; // Default value if not provided
                }
            }

            // Create main property
            $property = Property::create([
                'property_title' => $this->property_title,
                'slug' => Str::slug($this->property_title . '-' . uniqid()),
                'description' => $this->description,
                'owner_document_type' => $this->owner_document_type,
                'current_status' => $this->current_status,
                'property_address' => $this->property_address,
                'location' => $this->location,
                'price_in' => $this->price_in,
                'price' => $this->price,
                'city_id' => $this->city_id,
                'user_id' => Auth::id(),
                'listing_type_id' => $this->listing_type_id,
                'property_type_id' => $this->property_type_id,
                'image' => $imagePath,
                $foreignKeyColumn => $foreignKeyId,
            ]);

            $this->property_id = $property->id;
        }

        $this->step++;
    }

    public function updateProperty()
    {
        $property = Property::findOrFail($this->property_id);

        $property->update([
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'hospital_distance' => $this->hospital_distance,
            'railway_distance' => $this->railway_distance,
            'transport_distance' => $this->transport_distance,
            'bedrooms' => $this->bedrooms,
            'bathrooms' => $this->bathrooms,
            'balconies' => $this->balconies,
            'total_floors' => $this->total_floors,
            'furnishing_status' => $this->furnishing_status,
            'video_link' => $this->video_link,
            'court_case' => $this->court_case,
            'court_case_details' => $this->court_case_details,
        ]);

        session()->flash('success', 'Property Created & Updated Successfully!');
        return redirect()->route('dashboard');
    }

    protected function validatePropertyTypeFields()
    {
        switch ($this->property_type_id) {
            case 1:
                $this->validate([
                    'plot.plot_front' => 'nullable|numeric',
                    'plot.plot_back' => 'nullable|numeric',
                    'plot.plot_side_1' => 'nullable|numeric',
                    'plot.plot_side_2' => 'nullable|numeric',
                    'plot.plot_size' => 'required|numeric',
                    'plot.use_as' => 'required|string',
                    'plot.advantage' => 'nullable|string',
                ]);
                break;
            case 2:
                $this->validate([
                    'house.house_type' => 'required|string',
                ]);
                break;
            case 3:
                $this->validate([
                    'apartment.apartment_type' => 'required|string',
                ]);
                break;
            case 4:
                $this->validate([
                    'villa.villa_type' => 'required|string',
                ]);
                break;
            case 5:
                $this->validate([
                    'office.office_type' => 'required|string',
                ]);
                break;
            case 6:
                $this->validate([
                    'shop.shop_type' => 'required|string',
                ]);
                break;
            case 7:
                $this->validate([
                    'agriculture.land_type' => 'required|string',
                ]);
                break;
            case 8:
                $this->validate([
                    'industrial.land_type' => 'required|string',
                ]);
                break;
        }
    }
}
