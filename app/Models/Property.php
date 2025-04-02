<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'image',
        'description',
        'city_id',
        'area',
        'location',
        'price',
        'listing_type',
        'property_type',
        'bedrooms',
        'bathrooms',
        'balconies',
        'hospital_distance',
        'railway_distance',
        'transport_distance',
        'user_id',
        'status',
    ];

    // Generate slug automatically
    protected static function booted()
    {
        static::creating(function ($property) {
            $property->slug = Str::slug($property->title . '-' . uniqid());
        });
    }

    // Relationships
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

