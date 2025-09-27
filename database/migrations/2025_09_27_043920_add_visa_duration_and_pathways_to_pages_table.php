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
            if (!Schema::hasColumn('pages', 'visa_duration')) {
                // { initial: string, extension: string, permanent: string, notes?: string }
                $table->json('visa_duration')->nullable();
            }
            if (!Schema::hasColumn('pages', 'visa_pathways')) {
                // [ { title: string, description: string, requirements?: string, steps?: string[] } ]
                $table->json('visa_pathways')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            if (Schema::hasColumn('pages', 'visa_duration')) {
                $table->dropColumn('visa_duration');
            }
            if (Schema::hasColumn('pages', 'visa_pathways')) {
                $table->dropColumn('visa_pathways');
            }
        });
    }
};