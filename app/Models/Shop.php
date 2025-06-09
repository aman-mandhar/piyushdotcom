<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
        'shop_type',
        'shop_area_size',
        'shop_area_units',
        'shop_front',
        'shop_side_1',
        'shop_side_2',
        'shop_back',
        'shop_floor',
        'shop_facing',
        'advantage',
        'shop_security',
        'shop_parking',
        'shop_air_conditioned',
        'shop_power_backup',
        'shop_water_supply',
        'shop_toilet',
        'shop_storage',
        'shop_cctv',
        'shop_fire_safety',
        'image',
    ];

    public function property()
    {
        return $this->hasOne(Property::class, 'shop_id');
    }
}
