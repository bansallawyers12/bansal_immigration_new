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
        Schema::table('enhanced_appointments', function (Blueprint $table) {
            // Add payment-related columns
            $table->boolean('is_paid')->default(false)->after('status');
            $table->decimal('amount', 10, 2)->default(0)->after('is_paid');
            $table->string('promo_code')->nullable()->after('amount');
            $table->decimal('discount_amount', 10, 2)->default(0)->after('promo_code');
            $table->decimal('final_amount', 10, 2)->default(0)->after('discount_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('enhanced_appointments', function (Blueprint $table) {
            $table->dropColumn([
                'is_paid',
                'amount', 
                'promo_code',
                'discount_amount',
                'final_amount'
            ]);
        });
    }
};