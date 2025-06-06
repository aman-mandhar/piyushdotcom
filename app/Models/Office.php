<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    protected $fillable = [
        'office_type',
        'office_area_size',
        'office_area_units',
        'floor_number',
        'office_facing',
    ];

    public function property()
    {
        return $this->hasOne(Property::class);
    }
}

