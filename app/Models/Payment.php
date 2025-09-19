<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'stripe_payment_intent_id',
        'stripe_session_id',
        'amount',
        'currency',
        'status',
        'payment_method',
        'stripe_metadata',
        'promo_code',
        'discount_amount',
        'final_amount',
        'paid_at',
        'refunded_at',
        'refund_reason'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'final_amount' => 'decimal:2',
        'stripe_metadata' => 'array',
        'paid_at' => 'datetime',
        'refunded_at' => 'datetime'
    ];

    /**
     * Relationship with Appointment
     */
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    /**
     * Scope for successful payments
     */
    public function scopeSuccessful(Builder $query)
    {
        return $query->where('status', 'succeeded');
    }

    /**
     * Scope for pending payments
     */
    public function scopePending(Builder $query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope for failed payments
     */
    public function scopeFailed(Builder $query)
    {
        return $query->where('status', 'failed');
    }

    /**
     * Check if payment is successful
     */
    public function isSuccessful()
    {
        return $this->status === 'succeeded';
    }

    /**
     * Check if payment is pending
     */
    public function isPending()
    {
        return $this->status === 'pending';
    }

    /**
     * Check if payment is failed
     */
    public function isFailed()
    {
        return $this->status === 'failed';
    }

    /**
     * Mark payment as successful
     */
    public function markAsSuccessful()
    {
        $this->update([
            'status' => 'succeeded',
            'paid_at' => now()
        ]);
    }

    /**
     * Mark payment as failed
     */
    public function markAsFailed()
    {
        $this->update(['status' => 'failed']);
    }

    /**
     * Refund payment
     */
    public function refund($reason = null)
    {
        $this->update([
            'status' => 'refunded',
            'refunded_at' => now(),
            'refund_reason' => $reason
        ]);
    }
}