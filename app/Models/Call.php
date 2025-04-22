<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    use HasFactory;

    protected $table = 'calls';
    protected $fillable = [
        'user_id',
        'property_id',
        'vehicle_id',
        'directory_id',
        'city_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }
    public function directory()
    {
        return $this->belongsTo(BusinessDirectory::class, 'directory_id');
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function callRegister()
    {
        return $this->hasMany(CallProgress::class, 'call_id');
    }
    public function callRegisterCount()
    {
        return $this->hasMany(CallProgress::class, 'call_id')->count();
    }
}
