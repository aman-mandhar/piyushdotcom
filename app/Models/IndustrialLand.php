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
    ];

    public function property()
    {
        return $this->hasOne(Property::class);
    }
}
