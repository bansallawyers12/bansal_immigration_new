<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Page;
use Illuminate\Support\Facades\DB;

class ImportVisaProcessingTimes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'visa:import-processing-times {file=public/Global processing time.csv} {--dry-run : Show what would be updated without making changes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import visa processing times from CSV file and update existing visa pages';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filePath = $this->argument('file');
        $dryRun = $this->option('dry-run');

        if (!file_exists($filePath)) {
            $this->error("File not found: {$filePath}");
            return 1;
        }

        $this->info("Reading visa processing times from: {$filePath}");
        if ($dryRun) {
            $this->warn("DRY RUN MODE - No changes will be made");
        }

        $csvData = $this->readCsvFile($filePath);
        if (empty($csvData)) {
            $this->error("No data found in CSV file");
            return 1;
        }

        $this->info("Found " . count($csvData) . " processing time entries");

        $stats = [
            'matched' => 0,
            'updated' => 0,
            'not_found' => 0,
            'errors' => 0
        ];

        $progressBar = $this->output->createProgressBar(count($csvData));
        $progressBar->start();

        foreach ($csvData as $row) {
            try {
                $result = $this->processProcessingTime($row, $dryRun);
                $stats[$result]++;
            } catch (\Exception $e) {
                $stats['errors']++;
                $this->newLine();
                $this->error("Error processing: " . ($row['Visa Subclass'] ?? 'Unknown') . " - " . $e->getMessage());
            }
            
            $progressBar->advance();
        }

        $progressBar->finish();
        $this->newLine(2);

        // Display results
        $this->info("Import Results:");
        $this->table(
            ['Status', 'Count'],
            [
                ['Matched & Updated', $stats['updated']],
                ['Matched (No Changes)', max(0, $stats['matched'] - $stats['updated'])],
                ['Not Found', $stats['not_found']],
                ['Errors', $stats['errors']],
                ['Total Processed', count($csvData)]
            ]
        );

        if ($dryRun) {
            $this->warn("This was a dry run. Use --no-dry-run to apply changes.");
        } else {
            $this->info("Import completed successfully!");
        }

        return 0;
    }

    /**
     * Read and parse the CSV file
     */
    private function readCsvFile(string $filePath): array
    {
        $data = [];
        $handle = fopen($filePath, 'r');
        
        if ($handle === false) {
            throw new \Exception("Could not open file: {$filePath}");
        }

        $headers = fgetcsv($handle);
        if (!$headers) {
            fclose($handle);
            throw new \Exception("Could not read headers from CSV file");
        }
        
        // Clean BOM from first header
        if (!empty($headers[0])) {
            $headers[0] = preg_replace('/^\xEF\xBB\xBF/', '', $headers[0]);
        }

        while (($row = fgetcsv($handle)) !== false) {
            if (count($row) === count($headers)) {
                $data[] = array_combine($headers, $row);
            }
        }

        fclose($handle);
        return $data;
    }

    /**
     * Process a single processing time entry
     */
    private function processProcessingTime(array $row, bool $dryRun): string
    {
        $visaSubclass = trim($row['Visa Subclass']);
        $visaType = trim($row['Visa Type'] ?? '');
        $stream = trim($row['Stream'] ?? '');
        $processed75 = trim($row['75% Processed In'] ?? '');
        $processed90 = trim($row['90% Processed In'] ?? '');
        
        // Skip empty rows or non-visa entries
        if (empty($visaSubclass) || !is_numeric($visaSubclass)) {
            return 'not_found';
        }
        
        // Try to find matching page by subclass number
        $page = $this->findMatchingPage($visaSubclass, $visaType, $stream);
        
        if (!$page) {
            return 'not_found';
        }

        // Build processing times array
        $processingTimes = $this->buildProcessingTimes($processed75, $processed90);
        
        // Check if processing times have changed
        $currentTimes = $page->visa_processing_times;
        $timesChanged = $this->processingTimesHaveChanged($currentTimes, $processingTimes);

        if (!$timesChanged) {
            return 'matched';
        }

        if (!$dryRun) {
            $page->update(['visa_processing_times' => $processingTimes]);
        }

        return 'updated';
    }

    /**
     * Find matching page for visa subclass
     */
    private function findMatchingPage(string $visaSubclass, string $visaType, string $stream): ?Page
    {
        // First try to find by subclass number in title or content
        $page = Page::where('title', 'LIKE', "%subclass {$visaSubclass}%")
            ->orWhere('title', 'LIKE', "%{$visaSubclass}%")
            ->orWhere('content', 'LIKE', "%subclass {$visaSubclass}%")
            ->first();
        
        if ($page) {
            return $page;
        }

        // Enhanced matching for 485 visa specifically
        if ($visaSubclass === '485') {
            $page = $this->find485VisaPage($visaType, $stream);
            if ($page) {
                return $page;
            }
        }

        // Try to find by visa type and subclass combination
        if (!empty($visaType)) {
            $searchTerms = [
                "{$visaType} visa subclass {$visaSubclass}",
                "{$visaType} {$visaSubclass}",
                "visa {$visaSubclass}",
                "subclass {$visaSubclass}"
            ];

            foreach ($searchTerms as $term) {
                $page = Page::where('title', 'LIKE', "%{$term}%")
                    ->orWhere('content', 'LIKE', "%{$term}%")
                    ->first();
                
                if ($page) {
                    return $page;
                }
            }
        }

        // Special cases for specific visa types
        $specialCases = $this->getSpecialCaseMappings($visaSubclass, $visaType, $stream);
        
        foreach ($specialCases as $searchTerm) {
            $page = Page::where('title', 'LIKE', "%{$searchTerm}%")
                ->orWhere('content', 'LIKE', "%{$searchTerm}%")
                ->first();
            
            if ($page) {
                return $page;
            }
        }

        return null;
    }

    /**
     * Special method to find 485 visa pages with enhanced matching
     */
    private function find485VisaPage(string $visaType, string $stream): ?Page
    {
        // Try different variations of 485 visa titles
        $searchPatterns = [
            'Temporary Graduate Visa Subclass 485',
            'Post Study Work Visa Subclass 485',
            'Temporary Graduate visa (subclass 485)',
            'Post Study Work visa (subclass 485)',
            'Graduate Work Visa',
            'Post Study Work Visa',
            'Temporary Graduate Visa',
            '485 visa',
            'subclass 485'
        ];

        foreach ($searchPatterns as $pattern) {
            $page = Page::where('title', 'LIKE', "%{$pattern}%")
                ->orWhere('content', 'LIKE', "%{$pattern}%")
                ->first();
            
            if ($page) {
                return $page;
            }
        }

        // If no exact match, try to find the most relevant 485 page
        $page = Page::where(function($query) {
            $query->where('title', 'LIKE', '%485%')
                  ->orWhere('content', 'LIKE', '%485%');
        })->where(function($query) {
            $query->where('title', 'LIKE', '%temporary%')
                  ->orWhere('title', 'LIKE', '%graduate%')
                  ->orWhere('title', 'LIKE', '%post study%')
                  ->orWhere('title', 'LIKE', '%post-study%');
        })->first();

        return $page;
    }

    /**
     * Get special case mappings for specific visa types
     */
    private function getSpecialCaseMappings(string $visaSubclass, string $visaType, string $stream): array
    {
        $mappings = [
            '600' => ['visitor visa', 'tourist visa'],
            '189' => ['skilled independent', 'points tested'],
            '190' => ['skilled nominated', 'state nominated'],
            '485' => ['temporary graduate', 'graduate work', 'post study work', 'post-study work'],
            '500' => ['student visa', 'study visa'],
            '100' => ['partner visa', 'spouse visa'],
            '101' => ['child visa'],
            '186' => ['employer nomination', 'ens'],
            '188' => ['business innovation', 'investment visa'],
            '417' => ['working holiday'],
            '462' => ['work and holiday'],
            '820' => ['partner visa', 'spouse visa'],
            '801' => ['partner visa', 'spouse visa'],
            '491' => ['skilled work regional', 'regional provisional'],
            '494' => ['skilled employer sponsored regional'],
            '887' => ['skilled regional'],
            '155' => ['resident return visa', 'rrv'],
            '157' => ['resident return visa', 'rrv'],
        ];

        return $mappings[$visaSubclass] ?? [];
    }

    /**
     * Build processing times array from CSV data
     */
    private function buildProcessingTimes(string $processed75, string $processed90): array
    {
        $processingTimes = [];

        // Map 75% to standard processing time
        if (!empty($processed75)) {
            $processingTimes['standard'] = $this->formatProcessingTime($processed75);
        }

        // Map 90% to priority/complex processing time
        if (!empty($processed90)) {
            $processingTimes['priority'] = $this->formatProcessingTime($processed90);
        }

        // If we have both, use the difference as complex
        if (!empty($processed75) && !empty($processed90)) {
            $processingTimes['complex'] = $this->formatProcessingTime($processed90) . ' (complex cases)';
        }

        return $processingTimes;
    }

    /**
     * Format processing time string
     */
    private function formatProcessingTime(string $time): string
    {
        // Clean up the time string
        $time = trim($time);
        
        // Convert to a more readable format
        if (strpos($time, 'days') !== false) {
            $days = (int) filter_var($time, FILTER_SANITIZE_NUMBER_INT);
            if ($days >= 30) {
                $months = round($days / 30, 1);
                return $months . ' months';
            }
            return $days . ' days';
        }
        
        if (strpos($time, 'months') !== false) {
            return $time;
        }
        
        if (strpos($time, 'weeks') !== false) {
            $weeks = (int) filter_var($time, FILTER_SANITIZE_NUMBER_INT);
            if ($weeks >= 4) {
                $months = round($weeks / 4, 1);
                return $months . ' months';
            }
            return $time;
        }
        
        // If it's just a number, assume it's days
        if (is_numeric($time)) {
            $days = (int) $time;
            if ($days >= 30) {
                $months = round($days / 30, 1);
                return $months . ' months';
            }
            return $days . ' days';
        }
        
        return $time;
    }

    /**
     * Check if processing times have changed
     */
    private function processingTimesHaveChanged($currentTimes, array $newTimes): bool
    {
        if (!$currentTimes || !is_array($currentTimes)) {
            return !empty($newTimes);
        }

        // Normalize arrays for comparison
        $current = $this->normalizeProcessingTimesArray($currentTimes);
        $new = $this->normalizeProcessingTimesArray($newTimes);

        return $current !== $new;
    }

    /**
     * Normalize processing times array for comparison
     */
    private function normalizeProcessingTimesArray(array $times): array
    {
        $normalized = [];
        foreach (['standard', 'priority', 'complex'] as $key) {
            if (isset($times[$key])) {
                $normalized[$key] = trim($times[$key]);
            }
        }
        return $normalized;
    }
}
