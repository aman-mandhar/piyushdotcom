<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndustrialLand extends Model
{
    protected $fillable = [
        'land_type',
        'land_area_size',
        'land_area_units',
        'land_facing',
        'land_zone',
        'land_access_road',
        'land_power_supply',
        'land_water_supply',
        'land_sewage_system',
        'land_boundary_wall',
        'land_fencing',
        'land_security',
        'land_cctv',
        'land_fire_safety',
        'land_railway_access',
        'advantage',
        'image',
    ];

    public function property()
    {
        return $this->hasOne(Property::class, 'industrial_land_id');
    }
}
