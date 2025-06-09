<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    protected $fillable = [
        'house_type',
        'house_area_size',
        'house_area_units',
        'construction_year',
        'renovation_year',
        'house_bedrooms',
        'house_bathrooms',
        'house_balconies',
        'house_floors',
        'house_facing',
        'house_furnished_status',
        'advantage',
        'image',
    ];
    public function property()
    {
        return $this->hasOne(Property::class, 'house_id');
    }
}
