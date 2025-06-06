<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $fillable = [
        'apartment_type',
        'apartment_area_size',
        'apartment_area_units',
        'apartment_facing',
    ];

    public function property()
    {
        return $this->hasOne(Property::class);
    }
}
