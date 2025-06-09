<?php

namespace App\Livewire;

use App\Models\{
    Property, ListingType, PropertyType, Plot, House, Apartment, Villa, Office, Shop,
    AgricultureLand, IndustrialLand, City
};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class SellProperty extends Component
{
    use WithFileUploads;

    public $step = 1;

    // Step 1
    public $listing_type_id, $property_type_id;

    // Step 2
    public $plot = [], $house = [], $apartment = [], $villa = [], $office = [], $shop = [],  $agriculture = [], $industrial = [];

    // Step 3
    public $property_title, $slug, $description, $owner_document_type, $current_status;
    public $property_address, $location, $price_in, $price, $city_id;

    // Step 4
    public $latitude, $longitude, $hospital_distance, $railway_distance, $transport_distance;
    public $image, $bedrooms, $bathrooms, $balconies, $total_floors, $furnishing_status;
    public $video_link, $court_case = 'No', $court_case_details;

    public $property_id;

    public function render()
    {
        return view('livewire.sell-property', [
            'listingTypes' => ListingType::all(),
            'propertyTypes' => PropertyType::all(),
            'cities' => City::all(),
        ]);
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'property_title') {
            $this->slug = $this->generateUniqueSlug($this->property_title);
        }

        if (in_array($propertyName, ['plot.plot_front', 'plot.plot_back', 'plot.plot_side_1', 'plot.plot_side_2'])) {
            $this->calculatePlotSize();
        }

        if (in_array($propertyName, ['shop.shop_front', 'shop.shop_back', 'shop.shop_side_1', 'shop.shop_side_2'])) {
            $this->calculateShopArea();
        }
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

    public function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        if (Property::where('slug', $slug)->exists()) {
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
                'description' => 'nullable|string',
                'owner_document_type' => 'required|string',
                'current_status' => 'required|string',
                'property_address' => 'required|string',
                'location' => 'required|string',
                'city_id' => 'required|exists:cities,id',
                'latitude' => 'nullable|numeric',
                'longitude' => 'nullable|numeric',
                'price_in' => 'required|string',
                'price' => 'required|numeric|min:0',
            ]);

            if ($this->latitude === null || $this->longitude === null) {
                $city = City::find($this->city_id);
                $this->latitude = $city->city_latitude ?? 0.0;
                $this->longitude = $city->city_longitude ?? 0.0;
            }

            $data = $this->getPropertyTypeModelAndId();

            $property = Property::create([
                'property_title' => $this->property_title,
                'slug' => $this->generateUniqueSlug($this->property_title),
                'description' => $this->description,
                'owner_document_type' => $this->owner_document_type,
                'current_status' => $this->current_status,
                'property_address' => $this->property_address,
                'location' => $this->location,
                'city_id' => $this->city_id,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
                'price_in' => $this->price_in,
                'price' => $this->price,
                'user_id' => Auth::id(),
                'listing_type_id' => $this->listing_type_id,
                'property_type_id' => $this->property_type_id,
                $data['column'] => $data['id'],
            ]);

            $this->property_id = $property->id;
        }

        $this->step++;
    }

    public function updateProperty()
    {
        $property = Property::findOrFail($this->property_id);

        $property->update([
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

        session()->flash('success', 'Property created and updated successfully!');
        return redirect()->route('dashboard');
    }

    protected function getPropertyTypeModelAndId()
    {
        $map = [
            1 => ['model' => Plot::class, 'data' => $this->plot, 'column' => 'plot_id'],
            2 => ['model' => House::class, 'data' => $this->house, 'column' => 'house_id'],
            3 => ['model' => Apartment::class, 'data' => $this->apartment, 'column' => 'apartment_id'],
            4 => ['model' => Villa::class, 'data' => $this->villa, 'column' => 'villa_id'],
            5 => ['model' => Office::class, 'data' => $this->office, 'column' => 'office_id'],
            6 => ['model' => Shop::class, 'data' => $this->shop, 'column' => 'shop_id'],
            7 => ['model' => AgricultureLand::class, 'data' => $this->agriculture, 'column' => 'agriculture_land_id'],
            8 => ['model' => IndustrialLand::class, 'data' => $this->industrial, 'column' => 'industrial_land_id'],
        ];

        $entry = $map[$this->property_type_id];
        $record = $entry['model']::create($entry['data']);

        return ['id' => $record->id, 'column' => $entry['column']];
    }

    protected function savePropertyTypeData()
    {
        return $this->getPropertyTypeModelAndId();
    }

    protected function validatePropertyTypeFields()
    {
        switch ($this->property_type_id) {
            case 1:
                $validated = $this->validate([
                                    'plot.plot_front' => 'nullable|numeric',
                                    'plot.plot_back' => 'nullable|numeric',
                                    'plot.plot_side_1' => 'nullable|numeric',
                                    'plot.plot_side_2' => 'nullable|numeric',
                                    'plot.plot_size' => 'required|numeric',
                                    'plot.use_as' => 'required|string',
                                    'plot.advantage' => 'nullable|string',
                                    'plot.plot_facing' => 'required|string',
                                    'plot.video_link' => 'nullable|url',
                                ]);

                $plotData = $validated['plot'];

                    if ($this->image) {
                        $this->validate(['image' => 'image|max:2048']);
                        $plotData['image'] = $this->image->store('properties', 'public');
                    }

                $this->plot = $plotData;
            break;
            case 2:
                $validated = $this->validate([
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
                                'video_link' => 'nullable|url',
                            ]);
                $houseData = $validated['house'];
                if ($this->image) {
                    $this->validate(['image' => 'image|max:2048']);
                    $houseData['image'] = $this->image->store('properties', 'public');
                }                
                $this->house = $houseData;
                dd($this->house);
            break;
            case 3:
                $validated = $this->validate([
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
                                'video_link' => 'nullable|url',
                            ]);
                $apartmentData = $validated['apartment'];
                if ($this->image) {
                    $this->validate(['image' => 'image|max:2048']);
                    $apartmentData['image'] = $this->image->store('properties', 'public');
                }                
                $this->apartment = $apartmentData;
                break;
            case 4:
                 $validated = $this->validate([
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
                                'video_link' => 'nullable|url',
                            ]);
                $villaData = $validated['villa'];
                if ($this->image) {
                    $this->validate(['image' => 'image|max:2048']);
                    $villaData['image'] = $this->image->store('properties', 'public');
                }
                $this->villa = $villaData;
                break;
            case 5:
                $validated = $this->validate([
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
                                'video_link' => 'nullable|url',
                            ]);
                $officeData = $validated['office'];
                if ($this->image) {
                    $this->validate(['image' => 'image|max:2048']);
                    $officeData['image'] = $this->image->store('properties', 'public');
                }
                $this->office = $officeData;
                break;
            case 6:
                $validated = $this->validate([
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
                                'video_link' => 'nullable|url',
                            ]);
                $shopData = $validated['shop'];
                if ($this->image) {
                    $this->validate(['image' => 'image|max:2048']);
                    $shopData['image'] = $this->image->store('properties', 'public');
                }
                $this->shop = $shopData;
                break;
            case 7:
                $validated = $this->validate([
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
                                'video_link' => 'nullable|url',
                            ]);
                $agricultureData = $validated['agriculture'];
                if ($this->image) {
                    $this->validate(['image' => 'image|max:2048']);
                    $agricultureData['image'] = $this->image->store('properties', 'public');
                }
                $this->agriculture = $agricultureData;
                break;
            case 8:
                $validated = $this->validate([
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
                                'video_link' => 'nullable|url',
                            ]);
                $industrialData = $validated['industrial'];

                if ($this->image) {
                    $this->validate(['image' => 'image|max:2048']);
                    $industrialData['image'] = $this->image->store('properties', 'public');
                }
                $this->industrial = $industrialData;
                break;
        }
    }
}

