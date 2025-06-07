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

    public $step1;
    public function nextStep()
    {
        if ($this->step === 1) {
            $this->step1 = $this->validate([
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

    public $plotData,
        $houseData,
        $apartmentData,
        $villaData,
        $officeData,
        $shopData,
        $agricultureData,
        $industrialData;
    protected function validatePropertyTypeFields()
    {
        switch ($this->property_type_id) {
            case 1:
                $this->plotData = $this->validate([
                                'plot.plot_front' => 'nullable|numeric',
                                'plot.plot_back' => 'nullable|numeric',
                                'plot.plot_side_1' => 'nullable|numeric',
                                'plot.plot_side_2' => 'nullable|numeric',
                                'plot.plot_size' => 'required|numeric',
                                'plot.use_as' => 'required|string',
                                'plot.advantage' => 'nullable|string',
                                'plot.image' => 'nullable|image|max:2048',
                                'plot.plot_facing' => 'required|string',
                                'plot.video_link' => 'nullable|url',
                            ]);
                break;
            case 2:
                $this->houseData = $this->validate([
                                'house.house_type' => 'required|string',
                                'house.house_area_units' => 'required|in:Sq. Feet,Sq. Meters,Sq. Yards,Marla,Kanal',
                                'house.house_area_size' => 'required|string',
                                'house.construction_year' => 'nullable|date',
                                'house.renovation_year' => 'nullable|date',
                                'house.house_bedrooms' => 'nullable|in:1,2,3,4,5+',
                                'house.house_bathrooms' => 'nullable|in:1,2,3,4,5+',
                                'house.house_balconies' => 'nullable|in:1,2,3,4,5+',
                                'house.house_floors' => 'nullable|in:1,2,3,4,5+',
                                'house.house_facing' => 'nullable|in:North,North-East,North-West,South,South-East,South-West,East,West,N/A',
                                'house.house_furnishing_status' => 'nullable|in:Furnished,Semi-Furnished,Unfurnished',
                                'house.advantage' => 'nullable|in:Corner,On Road,Park Facing,Normal',
                                'image' => 'nullable|image|max:2048',
                                'video_link' => 'nullable|url',
                            ]);
                break;
            case 3:
                $this->apartmentData = $this->validate([
                                'apartment.apartment_type' => 'required|string',
                                'apartment.apartment_area_size' => 'required|string',
                                'apartment.apartment_area_units' => 'required|in:Sq. Feet,Sq. Meters,Sq. Yards,Marla,Kanal',
                                'apartment.apartment_floor' => 'nullable|in:Ground,1st,2nd,3rd,4th,5th,6th,7th,8th,9th,10th',
                                'apartment.apartment_bedrooms' => 'nullable|in:1,2,3,4,5+',
                                'apartment.apartment_bathrooms' => 'nullable|in:1,2,3,4,5+',
                                'apartment.apartment_balconies' => 'nullable|in:1,2,3,4,5+',
                                'apartment.apartment_floors' => 'nullable|in:1,2,3,4,5+',
                                'apartment.apartment_view' => 'nullable|in:Park,Road,City,Sea,Mountain,Garden,Pool,Other',
                                'apartment.apartment_facing' => 'nullable|in:North,North-East,North-West,South,South-East,South-West,East,West,N/A',
                                'apartment.apartment_furnishing_status' => 'nullable|in:Furnished,Semi-Furnished,Unfurnished',
                                'apartment.apartment_security' => 'nullable|in:Yes,No',
                                'apartment.apartment_elevator' => 'nullable|in:Yes,No',
                                'apartment.apartment_parking' => 'nullable|in:Yes,No',
                                'apartment.apartment_power_backup' => 'nullable|in:Yes,No',
                                'apartment.apartment_water_supply' => 'nullable|in:Yes,No',
                                'apartment.apartment_gas_supply' => 'nullable|in:Yes,No',
                                'apartment.apartment_waste_management' => 'nullable|in:Yes,No',
                                'apartment.apartment_gym' => 'nullable|in:Yes,No',
                                'apartment.apartment_swimming_pool' => 'nullable|in:Yes,No',
                                'apartment.apartment_clubhouse' => 'nullable|in:Yes,No',
                                'apartment.apartment_play_area' => 'nullable|in:Yes,No',
                                'apartment.apartment_security_guard' => 'nullable|in:Yes,No',
                                'apartment.apartment_fire_safety' => 'nullable|in:Yes,No',
                                'apartment.apartment_cctv' => 'nullable|in:Yes,No',
                                'apartment.apartment_intercom' => 'nullable|in:Yes,No',
                                'image' => 'nullable|image|max:2048',
                                'video_link' => 'nullable|url',
                            ]);
                break;
            case 4:
                 $this->villaData = $this->validate([
                                'villa.villa_type' => 'required|string',
                                'villa.villa_area_size' => 'required|string',
                                'villa.villa_area_units' => 'required|in:Sq. Feet,Sq. Meters,Sq. Yards,Marla,Kanal',
                                'villa.villa_facing' => 'nullable|in:North,North-East,North-West,South,South-East,South-West,East,West,N/A',
                                'villa.villa_bedrooms' => 'nullable|in:1,2,3,4,5+',
                                'villa.villa_bathrooms' => 'nullable|in:1,2,3,4,5+',
                                'villa.villa_balconies' => 'nullable|in:1,2,3,4,5+',
                                'villa.villa_floors' => 'nullable|in:1,2,3,4,5+',
                                'villa.villa_furnishing_status' => 'nullable|in:Furnished,Semi-Furnished,Unfurnished',
                                'villa.villa_swimming_pool' => 'nullable|in:Yes,No',
                                'villa.villa_garden' => 'nullable|in:Yes,No',
                                'villa.villa_parking' => 'nullable|in:Yes,No',
                                'villa.advantage' => 'nullable|in:Corner,On Road,Park Facing,Normal',
                                'image' => 'nullable|image|max:2048',
                                'video_link' => 'nullable|url',
                            ]);
                break;
            case 5:
                $this->officeData = $this->validate([
                                'office.office_type' => 'required|string',
                                'office.office_area_size' => 'required|string',
                                'office.office_area_units' => 'required|in:Sq. Feet,Sq. Meters,Sq. Yards',
                                'office.floor_number' => 'nullable|string',
                                'office.office_facing' => 'nullable|in:North,North-East,North-West,South,South-East,South-West,East,West,N/A',
                                'office.office_furnishing_status' => 'nullable|in:Furnished,Semi-Furnished,Unfurnished',
                                'office.office_air_conditioned' => 'nullable|in:Yes,No',
                                'office.office_meeting_room' => 'nullable|in:Yes,No',
                                'office.office_security' => 'nullable|in:Yes,No',
                                'office.office_parking' => 'nullable|in:Yes,No',
                                'office.office_internet' => 'nullable|in:Yes,No',
                                'office.office_power_backup' => 'nullable|in:Yes,No',
                                'office.office_cctv' => 'nullable|in:Yes,No',
                                'office.office_fire_safety' => 'nullable|in:Yes,No',
                                'office.office_reception' => 'nullable|in:Yes,No',
                                'office.office_kitchen' => 'nullable|in:Yes,No',
                                'office.office_toilet' => 'nullable|in:Yes,No',
                                'office.office_storage' => 'nullable|in:Yes,No',
                                'image' => 'nullable|image|max:2048',
                                'video_link' => 'nullable|url',
                            ]);
                break;
            case 6:
                $this->shopData = $this->validate([
                                'shop.shop_type' => 'required|string',
                                'shop.shop_area_size' => 'required|string',
                                'shop.shop_area_units' => 'required|in:Sq. Feet,Sq. Meters,Sq. Yards',
                                'shop.shop_front' => 'nullable|numeric',
                                'shop.shop_side_1' => 'nullable|numeric',
                                'shop.shop_side_2' => 'nullable|numeric',
                                'shop.shop_back' => 'nullable|numeric',
                                'shop.shop_floor' => 'nullable|integer',
                                'shop.shop_facing' => 'nullable|in:North,North-East,North-West,South,South-East,South-West,East,West,N/A',
                                'shop.advantage' => 'nullable|in:Corner,On Road,Park Facing,Normal',
                                'shop.shop_security' => 'nullable|in:Yes,No',
                                'shop.shop_parking' => 'nullable|in:Yes,No',
                                'shop.shop_air_conditioned' => 'nullable|in:Yes,No',
                                'shop.shop_power_backup' => 'nullable|in:Yes,No',
                                'shop.shop_water_supply' => 'nullable|in:Yes,No',
                                'shop.shop_toilet' => 'nullable|in:Yes,No',
                                'shop.shop_storage' => 'nullable|in:Yes,No',
                                'shop.shop_cctv' => 'nullable|in:Yes,No',
                                'shop.shop_fire_safety' => 'nullable|in:Yes,No',
                                'image' => 'nullable|image|max:2048',
                                'video_link' => 'nullable|url',
                            ]);
            case 7:
                $this->agricultureData = $this->validate([
                                'agriculture.land_type' => 'required|string',
                                'agriculture.land_area_size' => 'required|string',
                                'agriculture.land_area_units' => 'required|in:Feet,Meters,Yards,Marla,Kanal,Kila,Bigha,Acre',
                                'agriculture.land_facing' => 'nullable|in:North,North-East,North-West,South,South-East,South-West,East,West,N/A',
                                'agriculture.land_soil_type' => 'nullable|in:Loamy,Clayey,Sandy,Saline,Peaty,Chalky',
                                'agriculture.land_irrigation' => 'nullable|in:Yes,No',
                                'agriculture.land_cultivation' => 'nullable|in:Yes,No',
                                'agriculture.land_fencing' => 'nullable|in:Yes,No',
                                'agriculture.land_boundary_wall' => 'nullable|in:Yes,No',
                                'agriculture.land_access_road' => 'nullable|in:Yes,No',
                                'agriculture.land_power_supply' => 'nullable|in:Yes,No',
                                'agriculture.land_water_source' => 'nullable|in:Well,Tube Well,Canal,River,Borewell,Other',
                                'image' => 'nullable|image|max:2048',
                                'video_link' => 'nullable|url',
                            ]);
                break;
            case 8:
                $this->industrialData = $this->validate([
                                'industrial.land_type' => 'required|string',
                                'industrial.land_area_size' => 'required|string',
                                'industrial.land_area_units' => 'required|in:Feet,Meters,Yards,Marla,Kanal,Kila,Bigha,Acre',
                                'industrial.land_facing' => 'nullable|in:North,North-East,North-West,South,South-East,South-West,East,West,N/A',
                                'industrial.land_zone' => 'nullable|in:Industrial,Commercial,Mixed Use',
                                'industrial.land_access_road' => 'nullable|in:Yes,No',
                                'industrial.land_power_supply' => 'nullable|in:Yes,No',
                                'industrial.land_water_supply' => 'nullable|in:Yes,No',
                                'industrial.land_sewage_system' => 'nullable|in:Yes,No',
                                'industrial.land_boundary_wall' => 'nullable|in:Yes,No',
                                'industrial.land_fencing' => 'nullable|in:Yes,No',
                                'industrial.land_security' => 'nullable|in:Yes,No',
                                'industrial.land_cctv' => 'nullable|in:Yes,No',
                                'industrial.land_fire_safety' => 'nullable|in:Yes,No',
                                'industrial.land_railway_access' => 'nullable|in:Yes,No',
                                'industrial.advantage' => 'nullable|in:Corner,On Road,Park Facing,Normal',
                                'image' => 'nullable|image|max:2048',
                                'video_link' => 'nullable|url',
                            ]);
                break;
        }
    }
}
