<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Models\Page;

class ExportCmsPages extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'export:cms-pages {path=database/seeders/data/pages.json : Output JSON path relative to project root}';

    /**
     * The console command description.
     */
    protected $description = 'Export current CMS pages (pages table) to a JSON file for version control';

    public function handle(): int
    {
        $this->info('Exporting CMS pages...');

        $pages = Page::orderBy('order')->orderBy('id')->get();

        // Exclude timestamps if needed? Keep them to preserve history.
        $json = $pages->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        $relativePath = $this->argument('path');

        // Ensure directory exists
        $fullPath = base_path($relativePath);
        $dir = dirname($fullPath);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        file_put_contents($fullPath, $json);

        $this->info("Exported " . $pages->count() . " pages to {$relativePath}");
        return Command::SUCCESS;
    }
}



