<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = [
        'package_id',
        'user_id',
        'full_name',
        'email',
        'phone',
        'travel_date',
        'travelers',
        'special_requests',
        'total_amount',
        'status',
        'admin_notes',
        'payment_status',
        'payment_method',
        'payment_reference',
        'payhere_order_id',
        'payhere_payment_id',
    ];

    protected $casts = [
        'travel_date' => 'date',
        'total_amount' => 'decimal:2',
    ];

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getFormattedAmountAttribute(): string
    {
        return '$' . number_format($this->total_amount, 2);
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'pending' => 'bg-yellow-100 text-yellow-800',
            'confirmed' => 'bg-green-100 text-green-800',
            'cancelled' => 'bg-red-100 text-red-800',
            'completed' => 'bg-blue-100 text-blue-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getPaymentStatusBadgeAttribute(): string
    {
        return match($this->payment_status) {
            'pending' => 'bg-yellow-100 text-yellow-800',
            'paid' => 'bg-green-100 text-green-800',
            'failed' => 'bg-red-100 text-red-800',
            'cancelled' => 'bg-gray-100 text-gray-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    /**
     * Check if the booking can be edited by the user
     */
    public function canBeEdited(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Check if the booking can be cancelled by the user
     */
    public function canBeCancelled(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Get the booking status text for display
     */
    public function getStatusTextAttribute(): string
    {
        return match($this->status) {
            'pending' => 'Awaiting Confirmation',
            'confirmed' => 'Confirmed & Ready',
            'completed' => 'Tour Completed',
            'cancelled' => 'Booking Cancelled',
            default => 'Unknown Status',
        };
    }

    /**
     * Get the payment status text for display
     */
    public function getPaymentStatusTextAttribute(): string
    {
        return match($this->payment_status) {
            'pending' => 'Payment Pending',
            'paid' => 'Payment Completed',
            'failed' => 'Payment Failed',
            'cancelled' => 'Payment Cancelled',
            default => 'Unknown Payment Status',
        };
    }

    /**
     * Scope to get bookings for a specific user
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope to get bookings by status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope to get bookings by payment status
     */
    public function scopeByPaymentStatus($query, $paymentStatus)
    {
        return $query->where('payment_status', $paymentStatus);
    }
}
