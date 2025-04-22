<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallProgress extends Model
{
    use HasFactory;
    protected $table = 'call_progress';
    protected $fillable = [
        'call_id',
        'call_details',
        'user_id',
    ];
    protected $casts = [
        'call_id' => 'integer',
        'call_details' => 'string',
        'user_id' => 'integer',
    ];
    public function call()
    {
        return $this->belongsTo(Call::class, 'call_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
