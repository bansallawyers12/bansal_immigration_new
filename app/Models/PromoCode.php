<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class PromoCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'description',
        'type',
        'value',
        'minimum_amount',
        'maximum_discount',
        'usage_limit',
        'used_count',
        'valid_from',
        'valid_until',
        'is_active',
        'applicable_enquiry_types',
        'is_one_time_use',
        'used_by_users'
    ];

    protected $casts = [
        'value' => 'decimal:2',
        'minimum_amount' => 'decimal:2',
        'maximum_discount' => 'decimal:2',
        'used_count' => 'integer',
        'usage_limit' => 'integer',
        'valid_from' => 'datetime',
        'valid_until' => 'datetime',
        'is_active' => 'boolean',
        'applicable_enquiry_types' => 'array',
        'is_one_time_use' => 'boolean',
        'used_by_users' => 'array'
    ];

    /**
     * Scope for active promo codes
     */
    public function scopeActive(Builder $query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for valid promo codes (within date range)
     */
    public function scopeValid(Builder $query)
    {
        return $query->where(function($q) {
            $q->whereNull('valid_from')
              ->orWhere('valid_from', '<=', now());
        })->where(function($q) {
            $q->whereNull('valid_until')
              ->orWhere('valid_until', '>=', now());
        });
    }

    /**
     * Scope for available promo codes (not exceeded usage limit)
     */
    public function scopeAvailable(Builder $query)
    {
        return $query->where(function($q) {
            $q->whereNull('usage_limit')
              ->orWhereRaw('used_count < usage_limit');
        });
    }

    /**
     * Check if promo code is valid
     */
    public function isValid()
    {
        if (!$this->is_active) {
            return false;
        }

        $now = now();
        
        if ($this->valid_from && $this->valid_from > $now) {
            return false;
        }

        if ($this->valid_until && $this->valid_until < $now) {
            return false;
        }

        if ($this->usage_limit && $this->used_count >= $this->usage_limit) {
            return false;
        }

        return true;
    }

    /**
     * Check if promo code is applicable to enquiry type
     */
    public function isApplicableTo($enquiryType)
    {
        if (!$this->applicable_enquiry_types) {
            return true; // No restrictions
        }

        return in_array($enquiryType, $this->applicable_enquiry_types);
    }

    /**
     * Check if promo code meets minimum amount requirement
     */
    public function meetsMinimumAmount($amount)
    {
        return $amount >= $this->minimum_amount;
    }

    /**
     * Calculate discount amount
     */
    public function calculateDiscount($amount)
    {
        if (!$this->meetsMinimumAmount($amount)) {
            return 0;
        }

        $discount = 0;

        if ($this->type === 'percentage') {
            $discount = ($amount * $this->value) / 100;
            if ($this->maximum_discount) {
                $discount = min($discount, $this->maximum_discount);
            }
        } else {
            $discount = min($this->value, $amount);
        }

        return $discount;
    }

    /**
     * Increment usage count
     */
    public function incrementUsage()
    {
        $this->increment('used_count');
    }

    /**
     * Check if promo code is valid for given enquiry type and amount
     */
    public function isValidFor($enquiryType, $amount, $userId = null)
    {
        if (!$this->isValid()) {
            return false;
        }

        if (!$this->isApplicableTo($enquiryType)) {
            return false;
        }

        if (!$this->meetsMinimumAmount($amount)) {
            return false;
        }

        // Check one-time use restriction
        if ($this->is_one_time_use && $userId) {
            $usedByUsers = $this->used_by_users ?? [];
            if (in_array($userId, $usedByUsers)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Mark promo code as used by a user
     */
    public function markAsUsedBy($userId)
    {
        $this->increment('used_count');
        
        if ($this->is_one_time_use) {
            $usedByUsers = $this->used_by_users ?? [];
            $usedByUsers[] = $userId;
            $this->update(['used_by_users' => $usedByUsers]);
        }
    }

    /**
     * Find valid promo code by code
     */
    public static function findValid($code, $enquiryType = null, $amount = 0, $userId = null)
    {
        return static::where('code', $code)
                    ->active()
                    ->valid()
                    ->available()
                    ->when($enquiryType, function($query) use ($enquiryType) {
                        return $query->where(function($q) use ($enquiryType) {
                            $q->whereNull('applicable_enquiry_types')
                              ->orWhereJsonContains('applicable_enquiry_types', $enquiryType);
                        });
                    })
                    ->where('minimum_amount', '<=', $amount)
                    ->when($userId, function($query) use ($userId) {
                        return $query->where(function($q) use ($userId) {
                            $q->where('is_one_time_use', false)
                              ->orWhereJsonDoesntContain('used_by_users', $userId);
                        });
                    })
                    ->first();
    }
}