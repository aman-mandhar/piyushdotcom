<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgricultureLand extends Model
{
    protected $fillable = [
        'land_type',
        'land_area_size',
        'land_area_units',
        'land_facing',
        'land_soil_type',
        'land_irrigation',
        'land_cultivation',
        'land_fencing',
        'land_boundary_wall',
        'land_access_road',
        'land_water_source',
        'land_power_supply',
        'image',
    ];

    public function property()
    {
        return $this->hasOne(Property::class, 'agriculture_land_id');
    }
}