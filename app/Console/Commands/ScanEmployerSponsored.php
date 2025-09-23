<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ScanEmployerSponsored extends Command
{
    protected $signature = 'scan:employer-sponsored';

    protected $description = 'Scan database and code for any remaining references to employee-sponsored';

    public function handle(): int
    {
        $this->info('Scanning MySQL pages table...');

        $fields = ['title','excerpt','content','meta_title','meta_description','slug','template','route_name','category'];
        $patterns = [
            '%employee-sponsored%',
            '%Employee Sponsored%',
            '%employee sponsored%'
        ];

        $totals = 0;
        foreach ($fields as $field) {
            $fieldTotal = 0;
            foreach ($patterns as $pattern) {
                $count = DB::table('pages')->where($field, 'LIKE', $pattern)->count();
                $fieldTotal += $count;
                if ($count > 0) {
                    $this->line(sprintf('pages.%s matches %s: %d', $field, $pattern, $count));
                }
            }
            $totals += $fieldTotal;
        }

        $this->table(['Check', 'Count'], [
            ['Total pages references', $totals]
        ]);

        return 0;
    }
}


