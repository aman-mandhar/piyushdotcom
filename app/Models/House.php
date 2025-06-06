<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    protected $fillable = [
        'house_type',
        'house_area_size',
        'house_area_units',
        'house_facing',
    ];

    public function property()
    {
        return $this->hasOne(Property::class);
    }
}
