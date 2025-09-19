<?php

namespace App\Console\Commands;

use App\Models\Blog;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ImportBlogData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:blog-data 
                            {--source-table=blogs : The source table name in the bansal_immigration database}
                            {--dry-run : Run without actually importing data}
                            {--limit=0 : Limit the number of records to import (0 = no limit)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import blog data from bansal_immigration database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sourceTable = $this->option('source-table');
        $dryRun = $this->option('dry-run');
        $limit = (int) $this->option('limit');

        $this->info('Starting blog data import...');
        $this->info("Source table: {$sourceTable}");
        $this->info("Dry run: " . ($dryRun ? 'Yes' : 'No'));
        $this->info("Limit: " . ($limit > 0 ? $limit : 'No limit'));

        try {
            // Test connection to source database
            $this->info('Testing connection to bansal_immigration database...');
            $sourceConnection = DB::connection('bansal_immigration');
            $sourceConnection->getPdo();
            $this->info('✓ Connection successful');

            // Get source data
            $this->info("Fetching data from {$sourceTable}...");
            $query = $sourceConnection->table($sourceTable);
            
            if ($limit > 0) {
                $query->limit($limit);
            }
            
            $sourceData = $query->get();
            $this->info("Found " . $sourceData->count() . " records to import");

            if ($sourceData->isEmpty()) {
                $this->warn('No data found in source table');
                return;
            }

            // Show sample data structure
            $this->info('Sample record structure:');
            $sample = $sourceData->first();
            $this->table(
                ['Field', 'Value'],
                collect((array) $sample)->map(function ($value, $key) {
                    return [
                        'field' => $key,
                        'value' => is_string($value) ? Str::limit($value, 50) : (is_null($value) ? 'NULL' : $value)
                    ];
                })->toArray()
            );

            if ($dryRun) {
                $this->warn('DRY RUN - No data will be imported');
                return;
            }

            // Confirm before proceeding
            if (!$this->confirm('Do you want to proceed with the import?')) {
                $this->info('Import cancelled');
                return;
            }

            // Import data
            $this->info('Starting import process...');
            $imported = 0;
            $skipped = 0;
            $errors = 0;

            $progressBar = $this->output->createProgressBar($sourceData->count());
            $progressBar->start();

            foreach ($sourceData as $record) {
                try {
                    $blogData = $this->mapSourceData($record);
                    
                    // Check if blog already exists (by slug or title)
                    $existingBlog = Blog::where('slug', $blogData['slug'])
                        ->orWhere('title', $blogData['title'])
                        ->first();

                    if ($existingBlog) {
                        $skipped++;
                        $progressBar->advance();
                        continue;
                    }

                    Blog::create($blogData);
                    $imported++;
                } catch (\Exception $e) {
                    $errors++;
                    $this->error("Error importing record ID {$record->id}: " . $e->getMessage());
                }
                
                $progressBar->advance();
            }

            $progressBar->finish();
            $this->newLine(2);

            // Summary
            $this->info('Import completed!');
            $this->table(
                ['Status', 'Count'],
                [
                    ['Imported', $imported],
                    ['Skipped (duplicates)', $skipped],
                    ['Errors', $errors],
                    ['Total processed', $sourceData->count()]
                ]
            );

        } catch (\Exception $e) {
            $this->error('Import failed: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }

    /**
     * Map source data to target blog structure
     */
    private function mapSourceData($record): array
    {
        // Convert object to array
        $data = (array) $record;

        // Map fields - adjust these based on your source table structure
        $mappedData = [
            'title' => $data['title'] ?? $data['name'] ?? 'Untitled',
            'slug' => $this->generateSlug($data['title'] ?? $data['name'] ?? 'untitled', $data['id'] ?? null),
            'short_description' => $data['short_description'] ?? $data['excerpt'] ?? $data['summary'] ?? '',
            'description' => $data['description'] ?? $data['content'] ?? $data['body'] ?? '',
            'image' => $data['image'] ?? $data['featured_image'] ?? $data['thumbnail'] ?? null,
            'image_alt' => $data['image_alt'] ?? $data['alt_text'] ?? null,
            'meta_title' => $data['meta_title'] ?? $data['seo_title'] ?? null,
            'meta_description' => $data['meta_description'] ?? $data['seo_description'] ?? null,
            'meta_keywords' => $data['meta_keywords'] ?? $data['seo_keywords'] ?? null,
            'status' => $this->mapStatus($data['status'] ?? $data['active'] ?? $data['published'] ?? true),
            'featured' => $this->mapBoolean($data['featured'] ?? $data['is_featured'] ?? $data['highlighted'] ?? false),
            'author' => $data['author'] ?? $data['created_by'] ?? $data['writer'] ?? 'Admin',
            'published_at' => $this->mapDate($data['published_at'] ?? $data['created_at'] ?? $data['date'] ?? now()),
        ];

        return $mappedData;
    }

    /**
     * Generate a unique slug
     */
    private function generateSlug($title, $id = null): string
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        while (Blog::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * Map status field
     */
    private function mapStatus($status): bool
    {
        if (is_bool($status)) {
            return $status;
        }

        if (is_string($status)) {
            $status = strtolower($status);
            return in_array($status, ['1', 'true', 'active', 'published', 'live', 'yes']);
        }

        if (is_numeric($status)) {
            return (bool) $status;
        }

        return true; // Default to active
    }

    /**
     * Map boolean field
     */
    private function mapBoolean($value): bool
    {
        if (is_bool($value)) {
            return $value;
        }

        if (is_string($value)) {
            $value = strtolower($value);
            return in_array($value, ['1', 'true', 'yes', 'on']);
        }

        if (is_numeric($value)) {
            return (bool) $value;
        }

        return false;
    }

    /**
     * Map date field
     */
    private function mapDate($date): ?Carbon
    {
        if (empty($date)) {
            return now();
        }

        try {
            return Carbon::parse($date);
        } catch (\Exception $e) {
            return now();
        }
    }
}
