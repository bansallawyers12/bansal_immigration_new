<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Appointment;
use App\Models\BlockedTime;
use App\Models\User;
use Carbon\Carbon;

class UpdatedAppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data
        Appointment::truncate();
        BlockedTime::truncate();

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

        $this->createUpdatedAppointments($adminUser);
        $this->createUpdatedBlockedTimes($adminUser);

        $this->command->info('✅ Updated sample data created');
        $this->command->info('📊 Total appointments: ' . Appointment::count());
        $this->command->info('🚫 Total blocked times: ' . BlockedTime::count());
    }

    private function createUpdatedAppointments($adminUser)
    {
        $clients = [
            ['name' => 'Rajesh Kumar', 'email' => 'rajesh.kumar@email.com', 'phone' => '+1-555-0201'],
            ['name' => 'Emily Johnson', 'email' => 'emily.johnson@email.com', 'phone' => '+1-555-0202'],
            ['name' => 'Wei Zhang', 'email' => 'wei.zhang@email.com', 'phone' => '+1-555-0203'],
            ['name' => 'Carlos Rodriguez', 'email' => 'carlos.rodriguez@email.com', 'phone' => '+1-555-0205'],
        ];

        $enquiryTypes = ['tr', 'tourist', 'education', 'pr_complex'];
        $statuses = ['pending', 'confirmed', 'completed'];

        // Create appointments for the next 14 days
        for ($i = 0; $i < 14; $i++) {
            $date = Carbon::today()->addDays($i);
            
            if ($date->isWeekend()) continue;

            // Create 2-4 appointments per day
            for ($j = 0; $j < rand(2, 4); $j++) {
                $client = $clients[array_rand($clients)];
                $enquiryType = $enquiryTypes[array_rand($enquiryTypes)];
                
                $appointment = Appointment::create([
                    'full_name' => $client['name'],
                    'email' => $client['email'],
                    'phone' => $client['phone'],
                    'location' => 'office',
                    'meeting_type' => 'in_person',
                    'preferred_language' => 'english',
                    'enquiry_type' => $enquiryType,
                    'service_type' => 'paid',
                    'specific_service' => 'Consultation',
                    'enquiry_details' => 'Sample appointment for ' . $enquiryType . ' calendar testing.',
                    'appointment_date' => $date->toDateString(),
                    'appointment_time' => $this->getTimeForType($enquiryType),
                    'duration_minutes' => $this->getDurationForType($enquiryType),
                    'status' => $date->lt(Carbon::today()) ? 'completed' : $statuses[array_rand($statuses)],
                    'assigned_to' => $adminUser->id,
                ]);

                if ($appointment->status === 'confirmed') {
                    $appointment->generateConfirmationToken();
                }
            }
        }
    }

    private function createUpdatedBlockedTimes($adminUser)
    {
        // Lunch break for all calendars
        BlockedTime::create([
            'title' => 'Lunch Break',
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

        // TR specific training
        BlockedTime::create([
            'title' => 'TR Training Session',
            'blocked_date' => Carbon::today()->addDays(3),
            'start_time' => '14:00',
            'end_time' => '15:30',
            'is_all_day' => false,
            'recurrence_type' => 'weekly',
            'recurrence_end_date' => Carbon::today()->addMonth(),
            'blocked_enquiry_types' => ['tr'],
            'block_type' => 'busy',
            'is_active' => true,
            'created_by' => $adminUser->id
        ]);

        // Holiday for all calendars
        BlockedTime::create([
            'title' => 'Holiday',
            'blocked_date' => Carbon::today()->addDays(7),
            'start_time' => null,
            'end_time' => null,
            'is_all_day' => true,
            'recurrence_type' => 'none',
            'blocked_enquiry_types' => null,
            'block_type' => 'holiday',
            'is_active' => true,
            'created_by' => $adminUser->id
        ]);
    }

    private function getTimeForType($enquiryType)
    {
        $times = match($enquiryType) {
            'tr' => ['09:00', '09:30', '10:00', '14:00', '15:00'],
            'tourist' => ['10:00', '10:45', '14:15', '15:00'],
            'education' => ['09:30', '10:30', '15:30', '16:30'],
            'pr_complex' => ['11:00', '13:00', '14:00', '14:30'],
            default => ['10:00', '14:00']
        };
        
        return $times[array_rand($times)];
    }

    private function getDurationForType($enquiryType)
    {
        return match($enquiryType) {
            'tr' => 30,
            'tourist' => 45,
            'education' => 60,
            'pr_complex' => 30,
            default => 30
        };
    }
}
