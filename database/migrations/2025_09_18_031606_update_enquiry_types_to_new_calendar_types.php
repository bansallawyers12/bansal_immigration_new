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
        // First, add new enum values alongside old ones
        DB::statement("ALTER TABLE enhanced_appointments MODIFY COLUMN enquiry_type ENUM('immigration_consultation', 'visa_application', 'legal_advice', 'document_review', 'tr', 'tourist', 'education', 'pr_complex')");
        
        // Update existing data to new format
        DB::table('enhanced_appointments')->where('enquiry_type', 'immigration_consultation')->update(['enquiry_type' => 'tr']);
        DB::table('enhanced_appointments')->where('enquiry_type', 'visa_application')->update(['enquiry_type' => 'tourist']);
        DB::table('enhanced_appointments')->where('enquiry_type', 'legal_advice')->update(['enquiry_type' => 'education']);
        DB::table('enhanced_appointments')->where('enquiry_type', 'document_review')->update(['enquiry_type' => 'pr_complex']);
        
        // Finally, remove old enum values
        DB::statement("ALTER TABLE enhanced_appointments MODIFY COLUMN enquiry_type ENUM('tr', 'tourist', 'education', 'pr_complex')");
        
        // Update blocked_enquiry_types in blocked_times table
        $blockedTimes = DB::table('blocked_times')->whereNotNull('blocked_enquiry_types')->get();
        
        foreach ($blockedTimes as $blockedTime) {
            $enquiryTypes = json_decode($blockedTime->blocked_enquiry_types, true);
            if ($enquiryTypes) {
                $newTypes = [];
                foreach ($enquiryTypes as $type) {
                    switch ($type) {
                        case 'immigration_consultation':
                            $newTypes[] = 'tr';
                            break;
                        case 'visa_application':
                            $newTypes[] = 'tourist';
                            break;
                        case 'legal_advice':
                            $newTypes[] = 'education';
                            break;
                        case 'document_review':
                            $newTypes[] = 'pr_complex';
                            break;
                    }
                }
                
                DB::table('blocked_times')
                    ->where('id', $blockedTime->id)
                    ->update(['blocked_enquiry_types' => json_encode($newTypes)]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert the enum values back to original
        DB::statement("ALTER TABLE enhanced_appointments MODIFY COLUMN enquiry_type ENUM('immigration_consultation', 'visa_application', 'legal_advice', 'document_review')");
        
        // Revert existing data
        DB::table('enhanced_appointments')->where('enquiry_type', 'tr')->update(['enquiry_type' => 'immigration_consultation']);
        DB::table('enhanced_appointments')->where('enquiry_type', 'tourist')->update(['enquiry_type' => 'visa_application']);
        DB::table('enhanced_appointments')->where('enquiry_type', 'education')->update(['enquiry_type' => 'legal_advice']);
        DB::table('enhanced_appointments')->where('enquiry_type', 'pr_complex')->update(['enquiry_type' => 'document_review']);
        
        // Revert blocked_enquiry_types
        $blockedTimes = DB::table('blocked_times')->whereNotNull('blocked_enquiry_types')->get();
        
        foreach ($blockedTimes as $blockedTime) {
            $enquiryTypes = json_decode($blockedTime->blocked_enquiry_types, true);
            if ($enquiryTypes) {
                $oldTypes = [];
                foreach ($enquiryTypes as $type) {
                    switch ($type) {
                        case 'tr':
                            $oldTypes[] = 'immigration_consultation';
                            break;
                        case 'tourist':
                            $oldTypes[] = 'visa_application';
                            break;
                        case 'education':
                            $oldTypes[] = 'legal_advice';
                            break;
                        case 'pr_complex':
                            $oldTypes[] = 'document_review';
                            break;
                    }
                }
                
                DB::table('blocked_times')
                    ->where('id', $blockedTime->id)
                    ->update(['blocked_enquiry_types' => json_encode($oldTypes)]);
            }
        }
    }
};