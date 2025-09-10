<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Celebrity extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'known_for', 'booking_fee', 'years_active',
        'dob',
        'featured',
        'photo',
        'country',
    ];

    /**
     * Cast attributes to proper types
     */
    protected $casts = [
        'dob' => 'date',
        'booking_fee' => 'decimal:2',
    ];

    /**
     * Get the featured attribute as boolean
     */
    public function getFeaturedAttribute($value)
    {
        return $value === '1' || $value === 'featured' || $value === true;
    }

    /**
     * Set the featured attribute
     */
    public function setFeaturedAttribute($value)
    {
        $this->attributes['featured'] = $value ? '1' : '0';
    }

    /**
     * Scope to get only featured celebrities
     */
    public function scopeFeatured($query)
    {
        return $query->where(function($q) {
            $q->where('featured', '1')
              ->orWhere('featured', 'featured')
              ->orWhere('featured', true);
        });
    }


    public function celebbook()
    {
        return $this->hasMany(Booking::class, 'celebrity_id');
    }
}
