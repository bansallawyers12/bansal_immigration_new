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
        Schema::create('promo_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('description')->nullable();
            $table->enum('type', ['percentage', 'fixed']); // percentage or fixed amount
            $table->decimal('value', 10, 2); // percentage (0-100) or fixed amount
            $table->decimal('minimum_amount', 10, 2)->default(0); // minimum order amount
            $table->decimal('maximum_discount', 10, 2)->nullable(); // maximum discount amount
            $table->integer('usage_limit')->nullable(); // total usage limit
            $table->integer('used_count')->default(0);
            $table->timestamp('valid_from')->nullable();
            $table->timestamp('valid_until')->nullable();
            $table->boolean('is_active')->default(true);
            $table->json('applicable_enquiry_types')->nullable(); // which enquiry types can use this code
            $table->timestamps();
            
            $table->index(['code', 'is_active']);
            $table->index('valid_until');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promo_codes');
    }
};
