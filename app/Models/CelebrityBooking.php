<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CelebrityBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'celebrity_id',
        'booking_reference',
        'booking_type',  // New field for booking type
        'client_name',   // Renamed from full_name
        'client_email',  // Renamed from email
        'client_phone',  // Renamed from phone
        'full_name',     // Keep for backward compatibility
        'email',         // Keep for backward compatibility
        'phone',         // Keep for backward compatibility
        'gender',
        'address',
        'event_type',
        'event_location',
        'event_date',
        'event_time',
        'duration',
        'special_requests',
        'booking_fee',
        'service_fee',
        'total_amount',
        'payment_status',
        'booking_status',
        'notes',         // New field for storing JSON data
        'admin_notes',
        'cancellation_reason',
        'payment_method',
        'payment_proof',
        'payment_date',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'event_date' => 'date',
        'event_time' => 'datetime:H:i',
        'payment_date' => 'datetime',
        'booking_fee' => 'decimal:2',
        'service_fee' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'duration' => 'integer',
    ];

    /**
     * Generate a unique booking reference
     */
    public static function generateBookingReference()
    {
        $prefix = 'CBK-';
        $unique = false;
        $reference = '';

        while (!$unique) {
            $reference = $prefix . Str::upper(Str::random(8));
            $exists = self::where('booking_reference', $reference)->exists();
            if (!$exists) {
                $unique = true;
            }
        }

        return $reference;
    }

    /**
     * Get the user that owns the booking
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the celebrity being booked
     */
    public function celebrity()
    {
        return $this->belongsTo(Celebrity::class);
    }

    /**
     * Scope for pending bookings
     */
    public function scopePending($query)
    {
        return $query->where('booking_status', 'pending');
    }

    /**
     * Scope for approved bookings
     */
    public function scopeApproved($query)
    {
        return $query->where('booking_status', 'approved');
    }

    /**
     * Scope for completed bookings
     */
    public function scopeCompleted($query)
    {
        return $query->where('booking_status', 'completed');
    }

    /**
     * Calculate days remaining until the event
     */
    public function getDaysRemainingAttribute()
    {
        return now()->diffInDays($this->event_date, false);
    }

    /**
     * Check if the event is in the past
     */
    public function getIsInPastAttribute()
    {
        return now()->isAfter($this->event_date);
    }

    /**
     * Check if payment is pending
     */
    public function getIsPaymentPendingAttribute()
    {
        return $this->payment_status === 'pending';
    }
}