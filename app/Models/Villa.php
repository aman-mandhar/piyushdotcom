<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Villa extends Model
{
    protected $fillable = [
        'villa_type',
        'villa_area_size',
        'villa_area_units',
        'villa_facing',
        'villa_bedrooms',
        'villa_bathrooms',
        'villa_balconies',
        'villa_floors',
        'villa_furnishing_status',
        'villa_swimming_pool',
        'villa_garden',
        'villa_parking',
        'advantage',
        'image',
    ];

    public function property()
    {
        return $this->hasOne(Property::class, 'villa_id');
    }
}
