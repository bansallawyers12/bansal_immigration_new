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
        Schema::create('blocked_times', function (Blueprint $table) {
            $table->id();
            
            // Blocking Information
            $table->string('title'); // e.g., "Lunch Break", "Holiday", "Meeting"
            $table->text('description')->nullable();
            
            // Time Blocking
            $table->date('blocked_date');
            $table->time('start_time')->nullable(); // null means whole day
            $table->time('end_time')->nullable();   // null means whole day
            $table->boolean('is_all_day')->default(false);
            
            // Recurrence Support
            $table->enum('recurrence_type', [
                'none',
                'daily',
                'weekly', 
                'monthly',
                'yearly'
            ])->default('none');
            
            $table->json('recurrence_data')->nullable(); // Store recurrence rules
            $table->date('recurrence_end_date')->nullable();
            
            // Calendar Type Specific Blocking
            $table->json('blocked_enquiry_types')->nullable(); // null = block all types
            // Example: ["immigration_consultation", "visa_application"]
            
            // Management
            $table->boolean('is_active')->default(true)->index();
            $table->enum('block_type', [
                'unavailable',  // Time is completely unavailable
                'busy',         // Time is busy but can be overridden by admin
                'holiday',      // Public holiday or office closure
                'maintenance'   // System maintenance or office maintenance
            ])->default('unavailable');
            
            // Relations
            $table->unsignedBigInteger('created_by'); // Admin who created the block
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            
            $table->timestamps();
            
            // Indexes for performance
            $table->index(['blocked_date', 'is_active']);
            $table->index(['is_active', 'block_type']);
            $table->index('blocked_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blocked_times');
    }
};