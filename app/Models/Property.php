<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'property_title',
        'slug',

        // Owner Details
        'owner_name',
        'owner_contact',
        'owner_email',
        'owner_address',
        'owner_nationality',
        'owner_type',
        'owner_document_type',

        // Property Details
        'property_address',
        'latitude',
        'longitude',
        'court_case',
        'court_case_details',
        'current_status',
        'listing_type',
        'property_type',
        

        // Plot
        'plot_category',
        'measurement_unit',
        'plot_type',
        'plot_number',
        'plot_front',
        'plot_side_1',
        'plot_side_2',
        'plot_back',
        'plot_size',
        'price_per_sqft',

        // House / Apartment / Villa
        'floor_number',
        'bedrooms',
        'bathrooms',
        'balconies',
        'total_floors',
        'furnishing_status',

        // Office
        'office_floor',
        'office_bathrooms',
        'office_balconies',
        'office_area_size_unit',
        'office_area_size',
        'office_furnishing_status',

        // Shop
        'shop_type',
        'shop_area_size_unit',
        'shop_front',
        'shop_side_1',
        'shop_side_2',
        'shop_back',
        'shop_area_size',
        'shop_floor',
        'shop_with_water_connection',

        // Agriculture Land
        'land_type',
        'land_area_size_unit',
        'land_area_size',
        'current_status_of_land',

        // Common
        'price_in_unit',
        'price',
        'negotiable_price',
        'market_price',
        'hospital_distance',
        'railway_distance',
        'transport_distance',
        'image',
        'description',
        'city_id',
        'area_unit',
        'area',
        'location',
        'facing',
        'status',
        'user_id',
        'video_link',
    ];

    protected $casts = [
        'plot_front' => 'float',
        'plot_side_1' => 'float',
        'plot_side_2' => 'float',
        'plot_back' => 'float',
        'plot_size' => 'float',
        'price_per_sqft' => 'float',
        'price' => 'float',
        'market_price' => 'float',

        'office_area_size' => 'float',
        'shop_front' => 'float',
        'shop_side_1' => 'float',
        'shop_side_2' => 'float',
        'shop_back' => 'float',
        'shop_area_size' => 'float',
        'land_area_size' => 'float',

        'shop_with_water_connection' => 'boolean',
        'negotiable_price' => 'boolean',
    ];

    // 🔗 Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    // 📊 Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeByType($query, $type)
    {
        return $query->where('property_type', $type);
    }

    public function scopeForSale($query)
    {
        return $query->where('listing_type', 'Sale');
    }

    public function scopeInCity($query, $cityId)
    {
        return $query->where('city_id', $cityId);
    }

    public function scopeWithPriceLessThan($query, $price)
    {
        return $query->where('price', '<=', $price);
    }

    public function scopeWithPriceGreaterThan($query, $price)
    {
        return $query->where('price', '>=', $price);
    }

    public function scopeWithNegotiablePrice($query)
    {
        return $query->where('negotiable_price', true);
    }

    public function scopeWithNonNegotiablePrice($query)
    {
        return $query->where('negotiable_price', false);
    }

    public function scopeWithCourtCase($query)
    {
        return $query->where('court_case', 'Yes');
    }

    public function scopeWithoutCourtCase($query)
    {
        return $query->where('court_case', 'No');
    }

    public function scopeWithWaterConnection($query)
    {
        return $query->where('shop_with_water_connection', true);
    }

    public function scopeWithoutWaterConnection($query)
    {
        return $query->where('shop_with_water_connection', false);
    }

    public function scopeWithImage($query)
    {
        return $query->whereNotNull('image');
    }

    public function scopeWithoutImage($query)
    {
        return $query->whereNull('image');
    }

    public function scopeWithStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeWithSoftDeleted($query)
    {
        return $query->onlyTrashed();
    }

    public function scopeWithoutSoftDeleted($query)
    {
        return $query->withoutTrashed();
    }

    public function scopeWithCreatedAt($query, $date)
    {
        return $query->whereDate('created_at', $date);
    }

    public function scopeWithUpdatedAt($query, $date)
    {
        return $query->whereDate('updated_at', $date);
    }

    public function scopeWithDeletedAt($query, $date)
    {
        return $query->whereDate('deleted_at', $date);
    }

    public function scopeWithOwnerName($query, $name)
    {
        return $query->where('owner_name', 'like', "%{$name}%");
    }

    public function scopeWithOwnerContact($query, $contact)
    {
        return $query->where('owner_contact', 'like', "%{$contact}%");
    }

    public function scopeWithOwnerEmail($query, $email)
    {
        return $query->where('owner_email', 'like', "%{$email}%");
    }
}
