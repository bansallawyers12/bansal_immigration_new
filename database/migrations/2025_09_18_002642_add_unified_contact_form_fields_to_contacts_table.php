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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('contact_email');
            $table->string('contact_phone')->nullable();
            $table->string('subject')->nullable();
            $table->text('message')->nullable();
            $table->enum('status', ['unread', 'read', 'resolved', 'archived'])->default('unread');
            $table->string('forwarded_to')->nullable();
            $table->timestamp('forwarded_at')->nullable();
            $table->string('form_source', 50)->nullable();
            $table->string('form_variant', 50)->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();

            // Add indexes for common queries
            $table->index('status');
            $table->index('contact_email');
            $table->index(['form_source', 'form_variant']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};