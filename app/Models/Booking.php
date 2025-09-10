<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'phone',
        'sex',
        'email',
        'celebrity_id',
        'purpose',
        'booking_type',
        'method',
        'membership_plan',
    ];


    public function celebrity()
    {
        return $this->belongsTo(Celebrity::class);
    }
}
