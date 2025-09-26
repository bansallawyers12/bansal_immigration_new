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
            if (!Schema::hasColumn('pages', 'template')) {
                $table->string('template')->nullable()->index();
            }
            if (!Schema::hasColumn('pages', 'visa_highlights')) {
                $table->json('visa_highlights')->nullable();
            }
            if (!Schema::hasColumn('pages', 'visa_eligibility')) {
                $table->json('visa_eligibility')->nullable();
            }
            if (!Schema::hasColumn('pages', 'visa_benefits')) {
                $table->json('visa_benefits')->nullable();
            }
            if (!Schema::hasColumn('pages', 'visa_steps')) {
                $table->json('visa_steps')->nullable();
            }
            if (!Schema::hasColumn('pages', 'visa_faqs')) {
                $table->json('visa_faqs')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            if (Schema::hasColumn('pages', 'visa_highlights')) {
                $table->dropColumn('visa_highlights');
            }
            if (Schema::hasColumn('pages', 'visa_eligibility')) {
                $table->dropColumn('visa_eligibility');
            }
            if (Schema::hasColumn('pages', 'visa_benefits')) {
                $table->dropColumn('visa_benefits');
            }
            if (Schema::hasColumn('pages', 'visa_steps')) {
                $table->dropColumn('visa_steps');
            }
            if (Schema::hasColumn('pages', 'visa_faqs')) {
                $table->dropColumn('visa_faqs');
            }
            // Do not drop template column in down; it may be used elsewhere
        });
    }
};


