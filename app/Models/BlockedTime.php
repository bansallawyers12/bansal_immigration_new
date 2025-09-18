<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class BlockedTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'blocked_date',
        'start_time',
        'end_time', 
        'is_all_day',
        'recurrence_type',
        'recurrence_data',
        'recurrence_end_date',
        'blocked_enquiry_types',
        'is_active',
        'block_type',
        'created_by'
    ];

    protected $casts = [
        'blocked_date' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        'recurrence_end_date' => 'date',
        'recurrence_data' => 'array',
        'blocked_enquiry_types' => 'array',
        'is_all_day' => 'boolean',
        'is_active' => 'boolean'
    ];

    /**
     * Relationship with User (creator)
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Scope for active blocked times
     */
    public function scopeActive(Builder $query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for specific date
     */
    public function scopeForDate(Builder $query, $date)
    {
        return $query->where('blocked_date', $date);
    }

    /**
     * Scope for date range
     */
    public function scopeDateRange(Builder $query, $startDate, $endDate)
    {
        return $query->whereBetween('blocked_date', [$startDate, $endDate]);
    }

    /**
     * Scope for specific enquiry type
     */
    public function scopeForEnquiryType(Builder $query, string $enquiryType)
    {
        return $query->where(function ($q) use ($enquiryType) {
            $q->whereNull('blocked_enquiry_types')
              ->orWhereJsonContains('blocked_enquiry_types', $enquiryType);
        });
    }

    /**
     * Check if this blocked time affects a specific enquiry type
     */
    public function affectsEnquiryType(string $enquiryType): bool
    {
        // If no specific enquiry types are set, it affects all types
        if (empty($this->blocked_enquiry_types)) {
            return true;
        }

        return in_array($enquiryType, $this->blocked_enquiry_types);
    }

    /**
     * Check if a specific time slot is blocked
     */
    public function blocksTimeSlot(string $time): bool
    {
        if ($this->is_all_day) {
            return true;
        }

        if (!$this->start_time || !$this->end_time) {
            return $this->is_all_day;
        }

        $slotTime = Carbon::parse($time);
        $startTime = Carbon::parse($this->start_time);
        $endTime = Carbon::parse($this->end_time);

        return $slotTime->between($startTime, $endTime);
    }

    /**
     * Get all blocked time slots for a specific date and enquiry type
     */
    public static function getBlockedSlotsForDate($date, $enquiryType = null)
    {
        $query = static::active()
                      ->forDate($date);

        if ($enquiryType) {
            $query->forEnquiryType($enquiryType);
        }

        $blockedTimes = $query->get();
        $blockedSlots = [];

        foreach ($blockedTimes as $blockedTime) {
            if ($blockedTime->is_all_day) {
                // If it's all day, return a special marker
                $blockedSlots[] = [
                    'type' => 'all_day',
                    'title' => $blockedTime->title,
                    'block_type' => $blockedTime->block_type
                ];
            } else {
                $blockedSlots[] = [
                    'type' => 'time_range',
                    'start_time' => $blockedTime->start_time ? Carbon::parse($blockedTime->start_time)->format('H:i') : null,
                    'end_time' => $blockedTime->end_time ? Carbon::parse($blockedTime->end_time)->format('H:i') : null,
                    'title' => $blockedTime->title,
                    'block_type' => $blockedTime->block_type
                ];
            }
        }

        return collect($blockedSlots);
    }

    /**
     * Generate recurring blocked times
     */
    public function generateRecurringInstances($endDate = null)
    {
        if ($this->recurrence_type === 'none') {
            return collect();
        }

        $instances = collect();
        $currentDate = Carbon::parse($this->blocked_date);
        $endDate = $endDate ? Carbon::parse($endDate) : 
                  ($this->recurrence_end_date ? Carbon::parse($this->recurrence_end_date) : 
                   $currentDate->copy()->addYear());

        while ($currentDate->lte($endDate)) {
            if (!$currentDate->eq($this->blocked_date)) {
                $instances->push([
                    'title' => $this->title,
                    'description' => $this->description,
                    'blocked_date' => $currentDate->toDateString(),
                    'start_time' => $this->start_time,
                    'end_time' => $this->end_time,
                    'is_all_day' => $this->is_all_day,
                    'blocked_enquiry_types' => $this->blocked_enquiry_types,
                    'block_type' => $this->block_type,
                    'parent_id' => $this->id
                ]);
            }

            // Move to next occurrence based on recurrence type
            switch ($this->recurrence_type) {
                case 'daily':
                    $currentDate->addDay();
                    break;
                case 'weekly':
                    $currentDate->addWeek();
                    break;
                case 'monthly':
                    $currentDate->addMonth();
                    break;
                case 'yearly':
                    $currentDate->addYear();
                    break;
            }
        }

        return $instances;
    }

    /**
     * Check if time slot is available considering blocked times
     */
    public static function isTimeSlotAvailable($date, $time, $enquiryType = null, $duration = 30)
    {
        $blockedSlots = static::getBlockedSlotsForDate($date, $enquiryType);
        
        // Check for all-day blocks
        if ($blockedSlots->contains('type', 'all_day')) {
            return false;
        }

        $slotStart = Carbon::parse($date . ' ' . $time);
        $slotEnd = $slotStart->copy()->addMinutes($duration);

        foreach ($blockedSlots->where('type', 'time_range') as $blockedSlot) {
            if (!$blockedSlot['start_time'] || !$blockedSlot['end_time']) {
                continue;
            }

            $blockStart = Carbon::parse($date . ' ' . $blockedSlot['start_time']);
            $blockEnd = Carbon::parse($date . ' ' . $blockedSlot['end_time']);

            // Check if appointment slot overlaps with blocked time
            if ($slotStart->lt($blockEnd) && $slotEnd->gt($blockStart)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get block type display name
     */
    public function getBlockTypeDisplayAttribute()
    {
        return match($this->block_type) {
            'unavailable' => 'Unavailable',
            'busy' => 'Busy',
            'holiday' => 'Holiday',
            'maintenance' => 'Maintenance',
            default => ucfirst($this->block_type)
        };
    }

    /**
     * Get block type color
     */
    public function getBlockTypeColorAttribute()
    {
        return match($this->block_type) {
            'unavailable' => '#dc3545', // Red
            'busy' => '#ffc107',         // Yellow
            'holiday' => '#28a745',      // Green
            'maintenance' => '#6c757d',  // Gray
            default => '#6c757d'
        };
    }
}