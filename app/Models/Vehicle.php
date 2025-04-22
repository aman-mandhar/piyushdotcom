<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'owner_name',
        'owner_mobile',
        'owner_email',
        'owner_address',
        'city_id',
        'brand',
        'model',
        'variant',
        'registration_number',
        'registration_year',
        'km_driven',
        'fuel_type',
        'transmission',
        'no_of_owners',
        'insurance_status',
        'description',
        'price',
        'any_accident',
        'accident_detail',
        'loan_running',
        'loan_bank_name',
        'pending_emis',
        'emi_amount',
        'featured_image',
        'is_verified',
        'status',
    ];

    protected static function booted()
    {
        static::creating(function ($vehicle) {
            $vehicle->slug = Str::slug($vehicle->brand . '-' . $vehicle->model . '-' . uniqid());
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
