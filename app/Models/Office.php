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
        'office_furnishing_status',
        'office_air_conditioned',
        'office_meeting_room',
        'office_security',
        'office_parking',
        'office_internet',
        'office_power_backup',
        'office_cctv',
        'office_fire_safety',
        'office_reception',
        'office_kitchen',
        'office_toilet',
        'office_storage',
        'image',
    ];

    public function property()
    {
        return $this->hasOne(Property::class, 'office_id');
    }
}

