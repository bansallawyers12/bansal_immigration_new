<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateEmployerSponsored extends Command
{
    protected $signature = 'migrate:employer-sponsored-fix {--dry-run : Preview changes without applying}';

    protected $description = 'Update pages data from employee-sponsored to employer-sponsored across MySQL records';

    public function handle(): int
    {
        $dryRun = (bool) $this->option('dry-run');

        $updates = [
            // Category and slug
            "UPDATE pages SET category = 'employer-sponsored' WHERE category = 'employee-sponsored'",
            "UPDATE pages SET slug = 'employer-sponsored' WHERE category = 'employer-sponsored' AND slug = 'employee-sponsored'",
            // Template and route_name
            "UPDATE pages SET template = REPLACE(template, 'pages.employee-sponsored', 'pages.employer-sponsored') WHERE template LIKE 'pages.employee-sponsored%'",
            "UPDATE pages SET route_name = REPLACE(route_name, 'employee-sponsored.', 'employer-sponsored.') WHERE route_name LIKE 'employee-sponsored.%'",
            "UPDATE pages SET route_name = 'employer-sponsored.index' WHERE route_name = 'employee-sponsored.index'",
            // Titles and metas
            "UPDATE pages SET title = REPLACE(title, 'Employee Sponsored', 'Employer Sponsored') WHERE title LIKE '%Employee Sponsored%'",
            "UPDATE pages SET excerpt = REPLACE(excerpt, 'employee-sponsored', 'employer-sponsored') WHERE excerpt LIKE '%employee-sponsored%'",
            "UPDATE pages SET excerpt = REPLACE(excerpt, 'Employee Sponsored', 'Employer Sponsored') WHERE excerpt LIKE '%Employee Sponsored%'",
            "UPDATE pages SET meta_title = REPLACE(meta_title, 'Employee Sponsored', 'Employer Sponsored') WHERE meta_title LIKE '%Employee Sponsored%'",
            "UPDATE pages SET meta_description = REPLACE(meta_description, 'employee-sponsored', 'employer-sponsored') WHERE meta_description LIKE '%employee-sponsored%'",
            "UPDATE pages SET meta_description = REPLACE(meta_description, 'Employee Sponsored', 'Employer Sponsored') WHERE meta_description LIKE '%Employee Sponsored%'",
            // Content replacements
            "UPDATE pages SET content = REPLACE(content, 'Employee Sponsored', 'Employer Sponsored') WHERE content LIKE '%Employee Sponsored%'",
            "UPDATE pages SET content = REPLACE(content, 'employee sponsored', 'employer sponsored') WHERE content LIKE '%employee sponsored%'",
            "UPDATE pages SET content = REPLACE(content, 'employee-sponsored', 'employer-sponsored') WHERE content LIKE '%employee-sponsored%'",
            "UPDATE pages SET content = REPLACE(content, '/employee-sponsored', '/employer-sponsored') WHERE content LIKE '%/employee-sponsored%'",
        ];

        $this->info($dryRun ? 'DRY RUN: The following SQL statements would be executed:' : 'Applying updates...');
        foreach ($updates as $sql) {
            if ($dryRun) {
                $this->line($sql);
                continue;
            }
            DB::statement($sql);
        }

        if ($dryRun) {
            $this->newLine();
            $this->warn('No changes were applied (dry run).');
        } else {
            $this->info('Updates applied successfully.');
        }

        // Simple summary
        $counts = DB::table('pages')
            ->selectRaw("SUM(category='employer-sponsored') as employer_category_count")
            ->first();
        $this->table(['Metric', 'Value'], [
            ['Employer-sponsored category rows', $counts->employer_category_count ?? 0],
        ]);

        return 0;
    }
}


