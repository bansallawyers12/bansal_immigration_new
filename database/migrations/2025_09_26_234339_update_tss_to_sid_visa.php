<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update pages table - change TSS to SID
        DB::statement("UPDATE pages SET slug = 'sid-visa-482' WHERE slug = 'tss-visa-482'");
        DB::statement("UPDATE pages SET title = REPLACE(title, 'TSS Visa', 'Skill in Demand Visa') WHERE title LIKE '%TSS Visa%'");
        DB::statement("UPDATE pages SET title = REPLACE(title, 'Temporary Skill Shortage', 'Skill in Demand') WHERE title LIKE '%Temporary Skill Shortage%'");
        DB::statement("UPDATE pages SET excerpt = REPLACE(excerpt, 'TSS Visa', 'Skill in Demand Visa') WHERE excerpt LIKE '%TSS Visa%'");
        DB::statement("UPDATE pages SET content = REPLACE(content, 'TSS visa', 'Skill in Demand visa') WHERE content LIKE '%TSS visa%'");
        DB::statement("UPDATE pages SET content = REPLACE(content, 'TSS Visa', 'Skill in Demand Visa') WHERE content LIKE '%TSS Visa%'");
        DB::statement("UPDATE pages SET content = REPLACE(content, 'Temporary Skill Shortage', 'Skill in Demand') WHERE content LIKE '%Temporary Skill Shortage%'");
        DB::statement("UPDATE pages SET meta_title = REPLACE(meta_title, 'TSS Visa', 'Skill in Demand Visa') WHERE meta_title LIKE '%TSS Visa%'");
        DB::statement("UPDATE pages SET meta_title = REPLACE(meta_title, 'TSS 482', 'SID 482') WHERE meta_title LIKE '%TSS 482%'");
        DB::statement("UPDATE pages SET meta_description = REPLACE(meta_description, 'TSS Visa', 'Skill in Demand Visa') WHERE meta_description LIKE '%TSS Visa%'");
        DB::statement("UPDATE pages SET meta_description = REPLACE(meta_description, 'TSS 482', 'SID 482') WHERE meta_description LIKE '%TSS 482%'");
        DB::statement("UPDATE pages SET meta_description = REPLACE(meta_description, 'TSS to permanent', 'Skill in Demand visa to permanent') WHERE meta_description LIKE '%TSS to permanent%'");
        
        // Update route_name if it exists
        DB::statement("UPDATE pages SET route_name = REPLACE(route_name, 'tss-482', 'sid-482') WHERE route_name LIKE '%tss-482%'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse the changes
        DB::statement("UPDATE pages SET slug = 'tss-visa-482' WHERE slug = 'sid-visa-482'");
        DB::statement("UPDATE pages SET title = REPLACE(title, 'Skill in Demand Visa', 'TSS Visa') WHERE title LIKE '%Skill in Demand Visa%'");
        DB::statement("UPDATE pages SET title = REPLACE(title, 'Skill in Demand', 'Temporary Skill Shortage') WHERE title LIKE '%Skill in Demand%'");
        DB::statement("UPDATE pages SET excerpt = REPLACE(excerpt, 'Skill in Demand Visa', 'TSS Visa') WHERE excerpt LIKE '%Skill in Demand Visa%'");
        DB::statement("UPDATE pages SET content = REPLACE(content, 'Skill in Demand visa', 'TSS visa') WHERE content LIKE '%Skill in Demand visa%'");
        DB::statement("UPDATE pages SET content = REPLACE(content, 'Skill in Demand Visa', 'TSS Visa') WHERE content LIKE '%Skill in Demand Visa%'");
        DB::statement("UPDATE pages SET content = REPLACE(content, 'Skill in Demand', 'Temporary Skill Shortage') WHERE content LIKE '%Skill in Demand%'");
        DB::statement("UPDATE pages SET meta_title = REPLACE(meta_title, 'Skill in Demand Visa', 'TSS Visa') WHERE meta_title LIKE '%Skill in Demand Visa%'");
        DB::statement("UPDATE pages SET meta_title = REPLACE(meta_title, 'SID 482', 'TSS 482') WHERE meta_title LIKE '%SID 482%'");
        DB::statement("UPDATE pages SET meta_description = REPLACE(meta_description, 'Skill in Demand Visa', 'TSS Visa') WHERE meta_description LIKE '%Skill in Demand Visa%'");
        DB::statement("UPDATE pages SET meta_description = REPLACE(meta_description, 'SID 482', 'TSS 482') WHERE meta_description LIKE '%SID 482%'");
        DB::statement("UPDATE pages SET meta_description = REPLACE(meta_description, 'Skill in Demand visa to permanent', 'TSS to permanent') WHERE meta_description LIKE '%Skill in Demand visa to permanent%'");
        
        // Reverse route_name changes
        DB::statement("UPDATE pages SET route_name = REPLACE(route_name, 'sid-482', 'tss-482') WHERE route_name LIKE '%sid-482%'");
    }
};