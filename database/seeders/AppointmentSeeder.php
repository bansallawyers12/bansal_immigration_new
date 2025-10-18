<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Appointment;
use App\Models\BlockedTime;
use App\Models\User;
use Carbon\Carbon;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure we have at least one admin user
        $adminUser = User::first();
        if (!$adminUser) {
            $adminUser = User::create([
                'name' => 'Admin User',
                'email' => 'admin@bansalimmigration.com',
                'password' => bcrypt('password'),
                'is_admin' => true,
                'is_active' => true,
            ]);
        }

        $this->createSampleAppointments($adminUser);
        $this->createSampleBlockedTimes($adminUser);

        $this->command->info('✅ Created sample appointments and blocked times');
        $this->command->info('📊 Total appointments: ' . Appointment::count());
        $this->command->info('🚫 Total blocked times: ' . BlockedTime::count());
    }

    private function createSampleAppointments($adminUser)
    {
        $clients = [
            ['name' => 'John Smith', 'email' => 'john.smith@email.com', 'phone' => '+1-555-0101'],
            ['name' => 'Maria Garcia', 'email' => 'maria.garcia@email.com', 'phone' => '+1-555-0102'],
            ['name' => 'David Chen', 'email' => 'david.chen@email.com', 'phone' => '+1-555-0103'],
            ['name' => 'Sarah Johnson', 'email' => 'sarah.johnson@email.com', 'phone' => '+1-555-0104'],
            ['name' => 'Ahmed Hassan', 'email' => 'ahmed.hassan@email.com', 'phone' => '+1-555-0105'],
        ];

        $enquiryTypes = ['tr', 'tourist', 'education', 'pr_complex'];
        $statuses = ['pending', 'confirmed', 'completed'];
        $locations = ['office', 'online'];
        $meetingTypes = ['in_person', 'video_call', 'phone_call'];

        // Create appointments for next 14 days
        for ($i = 0; $i < 14; $i++) {
            $date = Carbon::today()->addDays($i);
            
            // Skip weekends
            if ($date->isWeekend()) {
                continue;
            }

            // Create 2-3 appointments per day
            for ($j = 0; $j < rand(2, 3); $j++) {
                $client = $clients[array_rand($clients)];
                $enquiryType = $enquiryTypes[array_rand($enquiryTypes)];
                
                $appointment = Appointment::create([
                    'full_name' => $client['name'],
                    'email' => $client['email'],
                    'phone' => $client['phone'],
                    'location' => $locations[array_rand($locations)],
                    'meeting_type' => $meetingTypes[array_rand($meetingTypes)],
                    'preferred_language' => 'english',
                    'enquiry_type' => $enquiryType,
                    'service_type' => 'paid',
                    'specific_service' => 'Initial Consultation',
                    'enquiry_details' => 'Sample appointment for testing the calendar system.',
                    'appointment_date' => $date->toDateString(),
                    'appointment_time' => $this->getRandomTimeForType($enquiryType),
                    'duration_minutes' => $this->getDurationForType($enquiryType),
                    'status' => $date->lt(Carbon::today()) ? 'completed' : $statuses[array_rand($statuses)],
                    'ip_address' => '127.0.0.1',
                    'user_agent' => 'Sample Data',
                    'assigned_to' => $adminUser->id,
                ]);

                if ($appointment->status === 'confirmed') {
                    $appointment->generateConfirmationToken();
                }
            }
        }
    }

    private function createSampleBlockedTimes($adminUser)
    {
        // Daily lunch break
        BlockedTime::create([
            'title' => 'Lunch Break',
            'description' => 'Daily lunch break',
            'blocked_date' => Carbon::today(),
            'start_time' => '12:00',
            'end_time' => '13:00',
            'is_all_day' => false,
            'recurrence_type' => 'daily',
            'recurrence_end_date' => Carbon::today()->addMonth(),
            'blocked_enquiry_types' => null,
            'block_type' => 'unavailable',
            'is_active' => true,
            'created_by' => $adminUser->id
        ]);

        // Holiday
        BlockedTime::create([
            'title' => 'Office Closure',
            'description' => 'Office closed for holiday',
            'blocked_date' => Carbon::today()->addDays(7),
            'start_time' => null,
            'end_time' => null,
            'is_all_day' => true,
            'recurrence_type' => 'none',
            'recurrence_end_date' => null,
            'blocked_enquiry_types' => null,
            'block_type' => 'holiday',
            'is_active' => true,
            'created_by' => $adminUser->id
        ]);

        // Staff meeting
        BlockedTime::create([
            'title' => 'Staff Meeting',
            'description' => 'Weekly team meeting',
            'blocked_date' => Carbon::today()->addDays(3),
            'start_time' => '15:00',
            'end_time' => '16:00',
            'is_all_day' => false,
            'recurrence_type' => 'weekly',
            'recurrence_end_date' => Carbon::today()->addMonth(),
            'blocked_enquiry_types' => ['legal_advice'],
            'block_type' => 'busy',
            'is_active' => true,
            'created_by' => $adminUser->id
        ]);
    }

    private function getRandomTimeForType($enquiryType)
    {
        $times = match($enquiryType) {
            'immigration_consultation' => ['09:00', '09:30', '10:00', '10:30', '14:00', '14:30', '15:00', '16:00'],
            'visa_application' => ['10:00', '10:45', '11:30', '14:15', '15:00'],
            'legal_advice' => ['09:30', '10:30', '15:30', '16:30'],
            'document_review' => ['11:00', '11:30', '13:00', '13:30', '14:00', '14:30'],
            default => ['10:00', '11:00', '14:00', '15:00']
        };
        
        return $times[array_rand($times)];
    }

    private function getDurationForType($enquiryType)
    {
        return match($enquiryType) {
            'immigration_consultation' => 30,
            'visa_application' => 45,
            'legal_advice' => 60,
            'document_review' => 30,
            default => 30
        };
    }
}
