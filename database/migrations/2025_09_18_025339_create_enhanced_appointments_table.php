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
        Schema::create('enhanced_appointments', function (Blueprint $table) {
            $table->id();
            
            // Client Information
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->string('location'); // office/online
            $table->string('meeting_type'); // in_person/video_call/phone_call
            $table->string('preferred_language')->default('english');
            
            // Service Information
            $table->enum('enquiry_type', [
                'immigration_consultation',
                'visa_application', 
                'legal_advice',
                'document_review'
            ])->index(); // Index for calendar filtering
            
            $table->string('service_type')->nullable(); // free/paid consultation
            $table->string('specific_service')->nullable(); // specific service selected
            $table->text('enquiry_details');
            
            // Appointment Scheduling
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->dateTime('appointment_datetime')->index(); // Combined for easy querying
            $table->integer('duration_minutes')->default(30); // Appointment duration
            
            // Status and Management
            $table->enum('status', [
                'pending',
                'confirmed', 
                'in_progress',
                'completed',
                'cancelled',
                'no_show'
            ])->default('pending')->index();
            
            $table->text('admin_notes')->nullable();
            $table->text('client_notes')->nullable();
            $table->string('confirmation_token')->nullable()->unique();
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->string('cancellation_reason')->nullable();
            
            // Tracking
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent')->nullable();
            $table->json('form_data')->nullable(); // Store original form submission
            
            // Relations
            $table->unsignedBigInteger('assigned_to')->nullable(); // Admin user assigned
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('set null');
            
            $table->timestamps();
            
            // Indexes for performance
            $table->index(['appointment_date', 'enquiry_type']);
            $table->index(['status', 'appointment_date']);
            $table->index(['enquiry_type', 'status']);
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enhanced_appointments');
    }
};