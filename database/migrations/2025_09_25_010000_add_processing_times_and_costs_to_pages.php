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
        Schema::table('pages', function (Blueprint $table) {
            if (!Schema::hasColumn('pages', 'visa_processing_times')) {
                // { standard: string, priority: string, complex: string }
                $table->json('visa_processing_times')->nullable();
            }
            if (!Schema::hasColumn('pages', 'visa_costs')) {
                // [ { label, amount, notes? } ]
                $table->json('visa_costs')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            if (Schema::hasColumn('pages', 'visa_processing_times')) {
                $table->dropColumn('visa_processing_times');
            }
            if (Schema::hasColumn('pages', 'visa_costs')) {
                $table->dropColumn('visa_costs');
            }
        });
    }
};


