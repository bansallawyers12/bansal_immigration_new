<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('calendar_settings', function (Blueprint $table) {
            $table->id();
            
            // Calendar Identification
            $table->enum('location', ['adelaide', 'melbourne'])->index();
            $table->enum('enquiry_type', ['tr', 'tourist', 'education', 'pr_complex'])->nullable()->index();
            // Note: enquiry_type is NULL for Adelaide (unified calendar)
            
            // Appointment Type
            $table->enum('appointment_type', ['free', 'paid'])->index();
            
            // Timing Configuration
            $table->time('start_time'); // e.g., '10:00:00'
            $table->time('end_time');   // e.g., '17:00:00'
            $table->integer('slot_duration_minutes'); // e.g., 15, 30, 45, 60
            
            // Additional Settings
            $table->json('days_of_week')->nullable(); // [1,2,3,4,5] = Mon-Fri, null = all days
            $table->time('lunch_break_start')->nullable();
            $table->time('lunch_break_end')->nullable();
            
            // Status
            $table->boolean('is_active')->default(true)->index();
            
            // Metadata
            $table->text('notes')->nullable(); // Admin notes about this calendar
            
            $table->timestamps();
            
            // Unique constraint: one setting per location+enquiry_type+appointment_type combination
            $table->unique(['location', 'enquiry_type', 'appointment_type'], 'unique_calendar_setting');
            
            // Indexes for fast lookup
            $table->index(['location', 'is_active']);
            $table->index(['location', 'enquiry_type', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendar_settings');
    }
};
