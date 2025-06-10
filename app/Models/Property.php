<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use SoftDeletes;

    protected $fillable = [
        // Mandatory fields
        'property_title',
        'slug',
        'description',
        'owner_document_type',
        'current_status',
        'property_address',
        'location',
        'price_in',
        'price',
        'status',
        // Non Mandatory fields
        'latitude',
        'longitude',
        'hospital_distance',
        'railway_distance',
        'transport_distance',
        'image',
        'bedrooms',
        'bathrooms',
        'balconies',
        'total_floors',
        'furnishing_status',
        'video_link',
        'court_case',
        'court_case_details',
        'city_id',
        'user_id',
        'listing_type_id',
        'property_type_id',
        'plot_id',
        'house_id',
        'apartment_id',
        'villa_id',
        'office_id',
        'shop_id',
        'agriculture_land_id',
        'industrial_land_id',
    ];

    // Relationships

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function listingType()
    {
        return $this->belongsTo(ListingType::class);
    }

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }

    public function plot()
    {
        return $this->belongsTo(Plot::class);
    }

    public function house()
    {
        return $this->belongsTo(House::class);
    }

    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }

    public function villa()
    {
        return $this->belongsTo(Villa::class);
    }

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function agricultureLand()
    {
        return $this->belongsTo(AgricultureLand::class);
    }

    public function industrialLand()
    {
        return $this->belongsTo(IndustrialLand::class);
    }

    public function getThumbnailAttribute()
    {
        switch ($this->property_type_id) {
            case 1:
                return $this->plot?->image;
            case 2:
                return $this->house?->image;
            case 3:
                return $this->apartment?->image;
            case 4:
                return $this->villa?->image;
            case 5:
                return $this->office?->image;
            case 6:
                return $this->shop?->image;
            case 7:
                return $this->agricultureLand?->image;
            case 8:
                return $this->industrialLand?->image;
            default:
                return null;
        }
    }
}
