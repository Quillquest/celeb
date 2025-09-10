<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class NewsletterSubscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'marketing_consent',
        'ip_address',
        'user_agent',
        'is_active'
    ];

    protected $casts = [
        'marketing_consent' => 'boolean',
        'is_active' => 'boolean',
        'subscribed_at' => 'datetime',
    ];

    protected $dates = [
        'subscribed_at',
        'created_at',
        'updated_at',
    ];

    /**
     * Scope to get only active subscriptions
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to get subscriptions with marketing consent
     */
    public function scopeWithMarketingConsent($query)
    {
        return $query->where('marketing_consent', true);
    }

    /**
     * Get the subscription date in a readable format
     */
    public function getSubscribedDateAttribute()
    {
        return $this->subscribed_at ? $this->subscribed_at->format('M d, Y') : null;
    }

    /**
     * Check if the subscription is recent (within last 30 days)
     */
    public function isRecentSubscription()
    {
        return $this->subscribed_at && $this->subscribed_at->diffInDays(Carbon::now()) <= 30;
    }

    /**
     * Unsubscribe the user
     */
    public function unsubscribe()
    {
        $this->update(['is_active' => false]);
    }

    /**
     * Resubscribe the user
     */
    public function resubscribe()
    {
        $this->update(['is_active' => true]);
    }
}
