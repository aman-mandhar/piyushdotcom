<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\City;
use App\Models\User;

class CountryMap extends Component
{
    public $propertiesJson;
    public $cities = [];
    public $default_latitude = 20.5937;
    public $default_longitude = 78.9629;

    public function mount()
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

        $this->propertiesJson = json_encode($properties);
        $this->cities = City::all();

        if (Auth::check()) {
            $user = User::with('city')->find(Auth::id());
            if ($user && $user->city) {
                $this->default_latitude = $user->city->country_latitude ?? $this->default_latitude;
                $this->default_longitude = $user->city->country_longitude ?? $this->default_longitude;
            }
        }
    }

    public function render()
    {
        return view('livewire.country-map');
    }
}
