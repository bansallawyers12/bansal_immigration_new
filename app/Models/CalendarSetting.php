<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CalendarSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'location',
        'enquiry_type',
        'appointment_type',
        'start_time',
        'end_time',
        'slot_duration_minutes',
        'days_of_week',
        'lunch_break_start',
        'lunch_break_end',
        'is_active',
        'notes'
    ];

    protected $casts = [
        'start_time' => 'datetime:H:i:s',
        'end_time' => 'datetime:H:i:s',
        'lunch_break_start' => 'datetime:H:i:s',
        'lunch_break_end' => 'datetime:H:i:s',
        'days_of_week' => 'array',
        'is_active' => 'boolean',
        'slot_duration_minutes' => 'integer'
    ];

    /**
     * Get calendar setting for a specific location, enquiry type, and appointment type
     */
    public static function getSettingFor($location, $enquiryType, $isPaid)
    {
        $appointmentType = $isPaid ? 'paid' : 'free';
        
        // For Adelaide, enquiry_type is NULL (unified calendar)
        $query = static::where('location', $location)
                      ->where('appointment_type', $appointmentType)
                      ->where('is_active', true);
        
        if ($location === 'adelaide') {
            $query->whereNull('enquiry_type');
        } else {
            $query->where('enquiry_type', $enquiryType);
        }
        
        return $query->first();
    }

    /**
     * Get all settings for a location
     */
    public static function getSettingsForLocation($location)
    {
        $query = static::where('location', $location)
                      ->where('is_active', true);
        
        if ($location === 'adelaide') {
            $query->whereNull('enquiry_type');
        }
        
        return $query->get();
    }

    /**
     * Get all settings for a specific calendar (location + enquiry type)
     */
    public static function getSettingsForCalendar($location, $enquiryType = null)
    {
        $query = static::where('location', $location)
                      ->where('is_active', true);
        
        if ($location === 'adelaide') {
            $query->whereNull('enquiry_type');
        } else {
            $query->where('enquiry_type', $enquiryType);
        }
        
        return $query->get();
    }

    /**
     * Get calendar display name
     */
    public function getCalendarNameAttribute()
    {
        if ($this->location === 'adelaide') {
            return 'Adelaide Office';
        }
        
        $enquiryNames = [
            'tr' => 'TR (TRand JRP)',
            'tourist' => 'Tourist Visa',
            'education' => 'Education',
            'pr_complex' => 'PR/Complex'
        ];
        
        return 'Melbourne - ' . ($enquiryNames[$this->enquiry_type] ?? ucfirst($this->enquiry_type));
    }

    /**
     * Get appointment type display name
     */
    public function getAppointmentTypeDisplayAttribute()
    {
        return ucfirst($this->appointment_type) . ' Appointments';
    }

    /**
     * Format time for display
     */
    public function getFormattedStartTimeAttribute()
    {
        return Carbon::parse($this->start_time)->format('g:i A');
    }

    public function getFormattedEndTimeAttribute()
    {
        return Carbon::parse($this->end_time)->format('g:i A');
    }

    /**
     * Get days of week display
     */
    public function getDaysOfWeekDisplayAttribute()
    {
        if (!$this->days_of_week) {
            return 'All Days';
        }

        $dayNames = [
            1 => 'Mon',
            2 => 'Tue',
            3 => 'Wed',
            4 => 'Thu',
            5 => 'Fri',
            6 => 'Sat',
            7 => 'Sun'
        ];

        return implode(', ', array_map(fn($day) => $dayNames[$day] ?? $day, $this->days_of_week));
    }

    /**
     * Check if a specific day of week is enabled
     */
    public function isDayEnabled($dayOfWeek)
    {
        if (!$this->days_of_week) {
            return true; // All days enabled
        }

        return in_array($dayOfWeek, $this->days_of_week);
    }

    /**
     * Scope for active settings
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for specific location
     */
    public function scopeForLocation($query, $location)
    {
        return $query->where('location', $location);
    }

    /**
     * Scope for specific enquiry type
     */
    public function scopeForEnquiryType($query, $enquiryType)
    {
        return $query->where('enquiry_type', $enquiryType);
    }

    /**
     * Scope for free appointments
     */
    public function scopeFree($query)
    {
        return $query->where('appointment_type', 'free');
    }

    /**
     * Scope for paid appointments
     */
    public function scopePaid($query)
    {
        return $query->where('appointment_type', 'paid');
    }
}
