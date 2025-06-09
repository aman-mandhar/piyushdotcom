<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $fillable = [
        'apartment_type',
        'apartment_area_size',
        'apartment_area_units',
        'apartment_floor',
        'apartment_bedrooms',
        'apartment_bathrooms',
        'apartment_balconies',
        'apartment_floors',
        'apartment_furnishing_status',
        'apartment_view',
        'apartment_security',
        'apartment_elevator',
        'apartment_parking',
        'apartment_power_backup',
        'apartment_water_supply',
        'apartment_gas_supply',
        'apartment_waste_management',
        'apartment_gym',
        'apartment_swimming_pool',
        'apartment_clubhouse',
        'apartment_play_area',
        'apartment_security_guard',
        'apartment_fire_safety',
        'apartment_cctv',
        'apartment_intercom',
        'apartment_facing',
        'image',
    ];

    public function property()
    {
        return $this->hasOne(Property::class, 'apartment_id');
    }
}
