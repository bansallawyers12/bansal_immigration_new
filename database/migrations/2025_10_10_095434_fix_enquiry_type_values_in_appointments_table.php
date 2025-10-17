<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, update any existing data to use the new enum values
        DB::statement("UPDATE enhanced_appointments SET enquiry_type = 'tr' WHERE enquiry_type = 'immigration_consultation'");
        DB::statement("UPDATE enhanced_appointments SET enquiry_type = 'tourist' WHERE enquiry_type = 'visa_application'");
        DB::statement("UPDATE enhanced_appointments SET enquiry_type = 'education' WHERE enquiry_type = 'legal_advice'");
        DB::statement("UPDATE enhanced_appointments SET enquiry_type = 'pr_complex' WHERE enquiry_type = 'document_review'");
        
        // Now alter the enum to use the new values
        DB::statement("ALTER TABLE enhanced_appointments MODIFY COLUMN enquiry_type ENUM('tr', 'tourist', 'education', 'pr_complex')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to old enum values
        DB::statement("UPDATE enhanced_appointments SET enquiry_type = 'immigration_consultation' WHERE enquiry_type = 'tr'");
        DB::statement("UPDATE enhanced_appointments SET enquiry_type = 'visa_application' WHERE enquiry_type = 'tourist'");
        DB::statement("UPDATE enhanced_appointments SET enquiry_type = 'legal_advice' WHERE enquiry_type = 'education'");
        DB::statement("UPDATE enhanced_appointments SET enquiry_type = 'document_review' WHERE enquiry_type = 'pr_complex'");
        
        DB::statement("ALTER TABLE enhanced_appointments MODIFY COLUMN enquiry_type ENUM('immigration_consultation', 'visa_application', 'legal_advice', 'document_review')");
    }
};