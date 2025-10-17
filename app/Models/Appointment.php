<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'enhanced_appointments';

    protected $fillable = [
        'full_name',
        'email', 
        'phone',
        'location',
        'meeting_type',
        'preferred_language',
        'enquiry_type',
        'service_type',
        'specific_service',
        'enquiry_details',
        'appointment_date',
        'appointment_time',
        'appointment_datetime',
        'duration_minutes',
        'status',
        'admin_notes',
        'client_notes',
        'confirmation_token',
        'confirmed_at',
        'cancelled_at',
        'cancellation_reason',
        'ip_address',
        'user_agent',
        'form_data',
        'assigned_to',
        'is_paid',
        'amount',
        'promo_code',
        'discount_amount',
        'final_amount'
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'appointment_datetime' => 'datetime',
        'confirmed_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'form_data' => 'array',
        'duration_minutes' => 'integer',
        'is_paid' => 'boolean',
        'amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'final_amount' => 'decimal:2'
    ];

    // Boot method to auto-generate appointment_datetime
    protected static function boot()
    {
        parent::boot();
        
        static::saving(function ($appointment) {
            if ($appointment->appointment_date && $appointment->appointment_time) {
                try {
                    $date = Carbon::parse($appointment->appointment_date);
                    // Don't parse appointment_time as datetime if it's already a time string
                    if (is_string($appointment->appointment_time) && preg_match('/^\d{2}:\d{2}(:\d{2})?$/', $appointment->appointment_time)) {
                        // It's a time string like "10:30" or "10:30:00"
                        list($hour, $minute) = explode(':', $appointment->appointment_time);
                        $appointment->appointment_datetime = $date->setTime((int)$hour, (int)$minute, 0);
                    } else {
                        // It's already a Carbon instance or datetime
                        $time = Carbon::parse($appointment->appointment_time);
                        $appointment->appointment_datetime = $date->setTime($time->hour, $time->minute);
                    }
                } catch (\Exception $e) {
                    \Log::error('Error generating appointment_datetime', [
                        'error' => $e->getMessage(),
                        'appointment_date' => $appointment->appointment_date,
                        'appointment_time' => $appointment->appointment_time,
                        'appointment_time_type' => gettype($appointment->appointment_time)
                    ]);
                    
                    // CRITICAL: Must provide fallback to satisfy database NOT NULL constraint
                    // Attempt multiple fallback strategies
                    try {
                        // Strategy 1: Use date + default 9 AM time
                        if ($appointment->appointment_date) {
                            $date = Carbon::parse($appointment->appointment_date);
                            $appointment->appointment_datetime = $date->setTime(9, 0, 0);
                        } else {
                            // Strategy 2: Use current datetime if date is also invalid
                            $appointment->appointment_datetime = now();
                        }
                    } catch (\Exception $fallbackError) {
                        // Strategy 3: Ultimate fallback - current datetime
                        \Log::critical('All fallback strategies failed for appointment_datetime', [
                            'fallback_error' => $fallbackError->getMessage(),
                            'appointment_date' => $appointment->appointment_date
                        ]);
                        $appointment->appointment_datetime = now();
                    }
                }
            }
        });
    }

    /**
     * Relationship with User (assigned admin)
     */
    public function assignedAdmin()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Relationship with Payment
     */
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    /**
     * Get pricing for different enquiry types
     */
    public static function getPricing()
    {
        return [
            'tr' => 150.00,        // TR (TRand JRP) - $150
            'tourist' => 100.00,   // Tourist Visa - $100
            'education' => 200.00, // Education - $200
            'pr_complex' => 300.00, // PR/Complex - $300
        ];
    }

    /**
     * Get price for this appointment's enquiry type
     */
    public function getPrice()
    {
        $pricing = self::getPricing();
        return $pricing[$this->enquiry_type] ?? 0;
    }

    /**
     * Check if appointment requires payment
     */
    public function requiresPayment()
    {
        return $this->is_paid && $this->getPrice() > 0;
    }

    /**
     * Calculate final amount after promo code
     */
    public function calculateFinalAmount($promoCode = null)
    {
        $baseAmount = $this->getPrice();
        
        if (!$promoCode) {
            return $baseAmount;
        }

        $promo = PromoCode::where('code', $promoCode)
                         ->where('is_active', true)
                         ->where(function($query) {
                             $query->whereNull('valid_from')
                                   ->orWhere('valid_from', '<=', now());
                         })
                         ->where(function($query) {
                             $query->whereNull('valid_until')
                                   ->orWhere('valid_until', '>=', now());
                         })
                         ->where(function($query) {
                             $query->whereNull('applicable_enquiry_types')
                                   ->orWhereJsonContains('applicable_enquiry_types', $this->enquiry_type);
                         })
                         ->where(function($query) {
                             $query->whereNull('usage_limit')
                                   ->orWhereRaw('used_count < usage_limit');
                         })
                         ->where('minimum_amount', '<=', $baseAmount)
                         ->first();

        if (!$promo) {
            return $baseAmount;
        }

        $discountAmount = 0;
        
        if ($promo->type === 'percentage') {
            $discountAmount = ($baseAmount * $promo->value) / 100;
            if ($promo->maximum_discount) {
                $discountAmount = min($discountAmount, $promo->maximum_discount);
            }
        } else {
            $discountAmount = min($promo->value, $baseAmount);
        }

        return max(0, $baseAmount - $discountAmount);
    }

    /**
     * Scope for filtering by enquiry type (calendar type)
     */
    public function scopeByEnquiryType(Builder $query, string $enquiryType)
    {
        return $query->where('enquiry_type', $enquiryType);
    }

    /**
     * Scope for filtering by date range
     */
    public function scopeDateRange(Builder $query, $startDate, $endDate)
    {
        return $query->whereBetween('appointment_date', [$startDate, $endDate]);
    }

    /**
     * Scope for filtering by status
     */
    public function scopeByStatus(Builder $query, string $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope for active appointments (not cancelled)
     */
    public function scopeActive(Builder $query)
    {
        return $query->whereNotIn('status', ['cancelled', 'no_show']);
    }

    /**
     * Scope for upcoming appointments
     */
    public function scopeUpcoming(Builder $query)
    {
        return $query->where('appointment_datetime', '>=', now())
                    ->whereIn('status', ['pending', 'confirmed']);
    }

    /**
     * Scope for past appointments
     */
    public function scopePast(Builder $query)
    {
        return $query->where('appointment_datetime', '<', now());
    }

    /**
     * Scope for today's appointments
     */
    public function scopeToday(Builder $query)
    {
        return $query->whereDate('appointment_date', today());
    }

    /**
     * Get appointments for a specific date and enquiry type
     */
    public static function getBookedSlotsForDate($date, $enquiryType = null)
    {
        $query = static::whereDate('appointment_date', $date)
                      ->active()
                      ->select('appointment_time', 'duration_minutes');

        if ($enquiryType) {
            $query->where('enquiry_type', $enquiryType);
        }

        return $query->get()->map(function ($appointment) {
            $startTime = Carbon::parse($appointment->appointment_time);
            $endTime = $startTime->copy()->addMinutes($appointment->duration_minutes);
            
            return [
                'start_time' => $startTime->format('H:i'),
                'end_time' => $endTime->format('H:i'),
                'duration' => $appointment->duration_minutes
            ];
        });
    }

    /**
     * Check if appointment can be cancelled
     */
    public function canBeCancelled()
    {
        return in_array($this->status, ['pending', 'confirmed']) && 
               $this->appointment_datetime > now()->addHours(24);
    }

    /**
     * Cancel appointment
     */
    public function cancel($reason = null)
    {
        $this->update([
            'status' => 'cancelled',
            'cancelled_at' => now(),
            'cancellation_reason' => $reason
        ]);
    }

    /**
     * Confirm appointment
     */
    public function confirm()
    {
        $this->update([
            'status' => 'confirmed',
            'confirmed_at' => now()
        ]);
    }

    /**
     * Get enquiry type display name
     */
    public function getEnquiryTypeDisplayAttribute()
    {
        return match($this->enquiry_type) {
            'tr' => 'TR (TRand JRP)',
            'tourist' => 'Tourist Visa',
            'education' => 'Education',
            'pr_complex' => 'PR/Complex',
            default => ucfirst(str_replace('_', ' ', $this->enquiry_type))
        };
    }

    /**
     * Get status display name with color
     */
    public function getStatusDisplayAttribute()
    {
        return match($this->status) {
            'pending' => ['name' => 'Pending', 'color' => 'warning'],
            'confirmed' => ['name' => 'Confirmed', 'color' => 'success'],
            'in_progress' => ['name' => 'In Progress', 'color' => 'info'],
            'completed' => ['name' => 'Completed', 'color' => 'primary'],
            'cancelled' => ['name' => 'Cancelled', 'color' => 'danger'],
            'no_show' => ['name' => 'No Show', 'color' => 'secondary'],
            default => ['name' => ucfirst($this->status), 'color' => 'secondary']
        };
    }

    /**
     * Get calendar color based on enquiry type
     */
    public function getCalendarColorAttribute()
    {
        return match($this->enquiry_type) {
            'tr' => '#007bff',        // Blue - TR (TRand JRP)
            'tourist' => '#28a745',   // Green - Tourist Visa
            'education' => '#ffc107', // Yellow - Education
            'pr_complex' => '#6f42c1', // Purple - PR/Complex
            default => '#6c757d'      // Gray
        };
    }

    /**
     * Generate unique confirmation token
     */
    public function generateConfirmationToken()
    {
        $this->confirmation_token = bin2hex(random_bytes(32));
        $this->save();
        return $this->confirmation_token;
    }
}