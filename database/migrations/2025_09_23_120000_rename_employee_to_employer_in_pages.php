<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1) Update category key
        DB::statement("UPDATE pages SET category = 'employer-sponsored' WHERE category = 'employee-sponsored'");

        // 2) Update index slug and route_name if present
        DB::statement("UPDATE pages SET slug = 'employer-sponsored' WHERE category = 'employer-sponsored' AND slug = 'employee-sponsored'");

        // 3) Update template references
        DB::statement("UPDATE pages SET template = REPLACE(template, 'pages.employee-sponsored', 'pages.employer-sponsored') WHERE template LIKE 'pages.employee-sponsored%'");

        // 4) Update route_name values, when stored
        DB::statement("UPDATE pages SET route_name = REPLACE(route_name, 'employee-sponsored.', 'employer-sponsored.') WHERE route_name LIKE 'employee-sponsored.%'");
        DB::statement("UPDATE pages SET route_name = 'employer-sponsored.index' WHERE route_name = 'employee-sponsored.index'");

        // 5) Text replacements in content-bearing fields
        // Employee Sponsored -> Employer Sponsored (case-sensitive phrase)
        DB::statement("UPDATE pages SET title = REPLACE(title, 'Employee Sponsored', 'Employer Sponsored') WHERE title LIKE '%Employee Sponsored%'");
        DB::statement("UPDATE pages SET excerpt = REPLACE(excerpt, 'employee-sponsored', 'employer-sponsored') WHERE excerpt LIKE '%employee-sponsored%'");
        DB::statement("UPDATE pages SET excerpt = REPLACE(excerpt, 'Employee Sponsored', 'Employer Sponsored') WHERE excerpt LIKE '%Employee Sponsored%'");
        DB::statement("UPDATE pages SET meta_title = REPLACE(meta_title, 'Employee Sponsored', 'Employer Sponsored') WHERE meta_title LIKE '%Employee Sponsored%'");
        DB::statement("UPDATE pages SET meta_description = REPLACE(meta_description, 'employee-sponsored', 'employer-sponsored') WHERE meta_description LIKE '%employee-sponsored%'");
        DB::statement("UPDATE pages SET meta_description = REPLACE(meta_description, 'Employee Sponsored', 'Employer Sponsored') WHERE meta_description LIKE '%Employee Sponsored%'");

        // Content field: handle both the hyphen and spacing variants and URLs
        DB::statement("UPDATE pages SET content = REPLACE(content, 'Employee Sponsored', 'Employer Sponsored') WHERE content LIKE '%Employee Sponsored%'");
        DB::statement("UPDATE pages SET content = REPLACE(content, 'employee sponsored', 'employer sponsored') WHERE content LIKE '%employee sponsored%'");
        DB::statement("UPDATE pages SET content = REPLACE(content, 'employee-sponsored', 'employer-sponsored') WHERE content LIKE '%employee-sponsored%'");
        DB::statement("UPDATE pages SET content = REPLACE(content, '/employee-sponsored', '/employer-sponsored') WHERE content LIKE '%/employee-sponsored%'");
    }

    public function down(): void
    {
        // Reverse replacements conservatively
        DB::statement("UPDATE pages SET content = REPLACE(content, '/employer-sponsored', '/employee-sponsored') WHERE content LIKE '%/employer-sponsored%'");
        DB::statement("UPDATE pages SET content = REPLACE(content, 'employer-sponsored', 'employee-sponsored') WHERE content LIKE '%employer-sponsored%'");
        DB::statement("UPDATE pages SET content = REPLACE(content, 'Employer Sponsored', 'Employee Sponsored') WHERE content LIKE '%Employer Sponsored%'");
        DB::statement("UPDATE pages SET excerpt = REPLACE(excerpt, 'employer-sponsored', 'employee-sponsored') WHERE excerpt LIKE '%employer-sponsored%'");
        DB::statement("UPDATE pages SET excerpt = REPLACE(excerpt, 'Employer Sponsored', 'Employee Sponsored') WHERE excerpt LIKE '%Employer Sponsored%'");
        DB::statement("UPDATE pages SET meta_title = REPLACE(meta_title, 'Employer Sponsored', 'Employee Sponsored') WHERE meta_title LIKE '%Employer Sponsored%'");
        DB::statement("UPDATE pages SET meta_description = REPLACE(meta_description, 'employer-sponsored', 'employee-sponsored') WHERE meta_description LIKE '%employer-sponsored%'");
        DB::statement("UPDATE pages SET meta_description = REPLACE(meta_description, 'Employer Sponsored', 'Employee Sponsored') WHERE meta_description LIKE '%Employer Sponsored%'");
        DB::statement("UPDATE pages SET title = REPLACE(title, 'Employer Sponsored', 'Employee Sponsored') WHERE title LIKE '%Employer Sponsored%'");

        DB::statement("UPDATE pages SET route_name = REPLACE(route_name, 'employer-sponsored.', 'employee-sponsored.') WHERE route_name LIKE 'employer-sponsored.%'");
        DB::statement("UPDATE pages SET route_name = 'employee-sponsored.index' WHERE route_name = 'employer-sponsored.index'");
        DB::statement("UPDATE pages SET template = REPLACE(template, 'pages.employer-sponsored', 'pages.employee-sponsored') WHERE template LIKE 'pages.employer-sponsored%'");

        DB::statement("UPDATE pages SET slug = 'employee-sponsored' WHERE category = 'employee-sponsored' AND slug = 'employer-sponsored'");
        DB::statement("UPDATE pages SET category = 'employee-sponsored' WHERE category = 'employer-sponsored'");
    }
};


