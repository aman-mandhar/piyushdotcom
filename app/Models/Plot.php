<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plot extends Model
{
    protected $fillable = [
        'plot_front',
        'plot_side_1',
        'plot_side_2',
        'plot_back',
        'plot_size',
        'plot_area_units',
        'advantage',
        'use_as',
        'image',
    ];

    public function property()
    {
        return $this->hasOne(Property::class, 'plot_id');
    }
}

