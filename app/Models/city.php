<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $table = 'cities';
    protected $fillable = [
        'name',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'city_id');
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}
