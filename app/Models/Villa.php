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
    ];

    public function property()
    {
        return $this->hasOne(Property::class);
    }
}
