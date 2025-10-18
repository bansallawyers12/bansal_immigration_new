<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CalendarSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // ADELAIDE - Unified Calendar (applies to all enquiry types)
            [
                'location' => 'adelaide',
                'enquiry_type' => null,
                'appointment_type' => 'free',
                'start_time' => '10:00:00',
                'end_time' => '16:00:00',
                'slot_duration_minutes' => 30,
                'days_of_week' => json_encode([1, 2, 3, 4, 5]), // Mon-Fri
                'lunch_break_start' => '12:00:00',
                'lunch_break_end' => '13:00:00',
                'is_active' => true,
                'notes' => 'Adelaide office - Free appointments'
            ],
            [
                'location' => 'adelaide',
                'enquiry_type' => null,
                'appointment_type' => 'paid',
                'start_time' => '09:00:00',
                'end_time' => '17:00:00',
                'slot_duration_minutes' => 30,
                'days_of_week' => json_encode([1, 2, 3, 4, 5]),
                'lunch_break_start' => '12:00:00',
                'lunch_break_end' => '13:00:00',
                'is_active' => true,
                'notes' => 'Adelaide office - Paid appointments'
            ],
            
            // MELBOURNE - TR Calendar
            [
                'location' => 'melbourne',
                'enquiry_type' => 'tr',
                'appointment_type' => 'free',
                'start_time' => '11:00:00',
                'end_time' => '15:00:00',
                'slot_duration_minutes' => 15,
                'days_of_week' => json_encode([1, 2, 3, 4, 5]),
                'lunch_break_start' => null,
                'lunch_break_end' => null,
                'is_active' => true,
                'notes' => 'Melbourne TR - Free appointments'
            ],
            [
                'location' => 'melbourne',
                'enquiry_type' => 'tr',
                'appointment_type' => 'paid',
                'start_time' => '09:00:00',
                'end_time' => '17:00:00',
                'slot_duration_minutes' => 30,
                'days_of_week' => json_encode([1, 2, 3, 4, 5]),
                'lunch_break_start' => '12:00:00',
                'lunch_break_end' => '13:00:00',
                'is_active' => true,
                'notes' => 'Melbourne TR - Paid appointments'
            ],
            
            // MELBOURNE - Tourist Calendar
            [
                'location' => 'melbourne',
                'enquiry_type' => 'tourist',
                'appointment_type' => 'free',
                'start_time' => '12:00:00',
                'end_time' => '16:00:00',
                'slot_duration_minutes' => 20,
                'days_of_week' => json_encode([1, 2, 3, 4, 5]),
                'lunch_break_start' => null,
                'lunch_break_end' => null,
                'is_active' => true,
                'notes' => 'Melbourne Tourist - Free appointments'
            ],
            [
                'location' => 'melbourne',
                'enquiry_type' => 'tourist',
                'appointment_type' => 'paid',
                'start_time' => '10:00:00',
                'end_time' => '16:00:00',
                'slot_duration_minutes' => 45,
                'days_of_week' => json_encode([1, 2, 3, 4, 5]),
                'lunch_break_start' => '12:30:00',
                'lunch_break_end' => '13:30:00',
                'is_active' => true,
                'notes' => 'Melbourne Tourist - Paid appointments'
            ],
            
            // MELBOURNE - Education Calendar
            [
                'location' => 'melbourne',
                'enquiry_type' => 'education',
                'appointment_type' => 'free',
                'start_time' => '13:00:00',
                'end_time' => '16:00:00',
                'slot_duration_minutes' => 30,
                'days_of_week' => json_encode([1, 2, 3, 4, 5]),
                'lunch_break_start' => null,
                'lunch_break_end' => null,
                'is_active' => true,
                'notes' => 'Melbourne Education - Free appointments'
            ],
            [
                'location' => 'melbourne',
                'enquiry_type' => 'education',
                'appointment_type' => 'paid',
                'start_time' => '09:30:00',
                'end_time' => '17:30:00',
                'slot_duration_minutes' => 60,
                'days_of_week' => json_encode([1, 2, 3, 4, 5]),
                'lunch_break_start' => '12:00:00',
                'lunch_break_end' => '14:00:00',
                'is_active' => true,
                'notes' => 'Melbourne Education - Paid appointments'
            ],
            
            // MELBOURNE - PR/Complex Calendar (Example from your requirement)
            [
                'location' => 'melbourne',
                'enquiry_type' => 'pr_complex',
                'appointment_type' => 'free',
                'start_time' => '12:00:00',
                'end_time' => '15:00:00',
                'slot_duration_minutes' => 15,
                'days_of_week' => json_encode([1, 2, 3, 4, 5]),
                'lunch_break_start' => null,
                'lunch_break_end' => null,
                'is_active' => true,
                'notes' => 'Melbourne PR/Complex - Free appointments (12 to 3 PM, 15-min slots as per requirement)'
            ],
            [
                'location' => 'melbourne',
                'enquiry_type' => 'pr_complex',
                'appointment_type' => 'paid',
                'start_time' => '10:00:00',
                'end_time' => '17:00:00',
                'slot_duration_minutes' => 30,
                'days_of_week' => json_encode([1, 2, 3, 4, 5]),
                'lunch_break_start' => null,
                'lunch_break_end' => null,
                'is_active' => true,
                'notes' => 'Melbourne PR/Complex - Paid appointments (10 to 5 PM, 30-min slots as per requirement)'
            ],
        ];

        foreach ($settings as $setting) {
            DB::table('calendar_settings')->insert(array_merge($setting, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
