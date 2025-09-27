<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Page;
use Illuminate\Support\Facades\DB;

class ImportVisaFees extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'visa:import-fees {file=public/visa-fees.csv} {--dry-run : Show what would be updated without making changes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import visa fees from CSV file and update existing visa pages';

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

        $this->info("Reading visa fees from: {$filePath}");
        if ($dryRun) {
            $this->warn("DRY RUN MODE - No changes will be made");
        }

        $csvData = $this->readCsvFile($filePath);
        if (empty($csvData)) {
            $this->error("No data found in CSV file");
            return 1;
        }

        $this->info("Found " . count($csvData) . " visa fee entries");

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
                $result = $this->processVisaFee($row, $dryRun);
                $stats[$result]++;
            } catch (\Exception $e) {
                $stats['errors']++;
                $this->newLine();
                $this->error("Error processing: " . ($row['Visa subclass'] ?? 'Unknown') . " - " . $e->getMessage());
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
     * Process a single visa fee entry
     */
    private function processVisaFee(array $row, bool $dryRun): string
    {
        $visaSubclass = trim($row['Visa subclass']);
        
        // Try to find matching page by title or slug
        $page = $this->findMatchingPage($visaSubclass);
        
        if (!$page) {
            return 'not_found';
        }

        // Build visa costs array
        $visaCosts = $this->buildVisaCosts($row);
        
        // Check if costs have changed
        $currentCosts = $page->visa_costs;
        $costsChanged = $this->costsHaveChanged($currentCosts, $visaCosts);

        if (!$costsChanged) {
            return 'matched';
        }

        if (!$dryRun) {
            $page->update(['visa_costs' => $visaCosts]);
        }

        return 'updated';
    }

    /**
     * Find matching page for visa subclass
     */
    private function findMatchingPage(string $visaSubclass): ?Page
    {
        // Extract subclass number (e.g., "189" from "Skilled Independent visa (subclass 189)")
        $subclassMatch = [];
        if (preg_match('/subclass\s+(\d+)/i', $visaSubclass, $subclassMatch)) {
            $subclassNumber = $subclassMatch[1];
            
            // Try to find by subclass number in title or content
            $page = Page::where('title', 'LIKE', "%subclass {$subclassNumber}%")
                ->orWhere('title', 'LIKE', "%{$subclassNumber}%")
                ->orWhere('content', 'LIKE', "%subclass {$subclassNumber}%")
                ->first();
            
            if ($page) {
                return $page;
            }
        }

        // Try to find by visa name variations
        $visaName = $this->extractVisaName($visaSubclass);
        
        $searchTerms = [
            $visaName,
            str_replace(['(', ')', 'subclass'], '', $visaSubclass),
            $visaSubclass
        ];

        foreach ($searchTerms as $term) {
            $term = trim($term);
            if (empty($term)) continue;

            $page = Page::where('title', 'LIKE', "%{$term}%")
                ->orWhere('content', 'LIKE', "%{$term}%")
                ->first();
            
            if ($page) {
                return $page;
            }
        }

        return null;
    }

    /**
     * Extract visa name from subclass string
     */
    private function extractVisaName(string $visaSubclass): string
    {
        // Remove subclass information and clean up
        $name = preg_replace('/\s*\(subclass\s+\d+[^)]*\)\s*/i', '', $visaSubclass);
        $name = preg_replace('/\s*-\s*.*$/', '', $name); // Remove stream information
        return trim($name);
    }

    /**
     * Build visa costs array from CSV row
     */
    private function buildVisaCosts(array $row): array
    {
        $costs = [];

        // Base application charge
        if (!empty($row['Base application charge'])) {
            $costs[] = [
                'label' => 'Base Application Fee',
                'amount' => $this->cleanAmount($row['Base application charge']),
                'notes' => 'Primary application fee'
            ];
        }

        // Additional applicant charge 18 and over
        if (!empty($row['Additional applicant charge 18 and over'])) {
            $costs[] = [
                'label' => 'Additional Applicant (18+)',
                'amount' => $this->cleanAmount($row['Additional applicant charge 18 and over']),
                'notes' => 'For each additional applicant 18 years and over'
            ];
        }

        // Additional applicant charge under 18
        if (!empty($row['Additional applicant charge under 18'])) {
            $costs[] = [
                'label' => 'Additional Applicant (Under 18)',
                'amount' => $this->cleanAmount($row['Additional applicant charge under 18']),
                'notes' => 'For each additional applicant under 18 years'
            ];
        }

        // Non-internet application charge
        if (!empty($row['Non-internet application charge'])) {
            $costs[] = [
                'label' => 'Non-Internet Application Fee',
                'amount' => $this->cleanAmount($row['Non-internet application charge']),
                'notes' => 'Paper application fee'
            ];
        }

        // Subsequent temporary application charge
        if (!empty($row['Subsequent temporary application charge'])) {
            $costs[] = [
                'label' => 'Subsequent Application Fee',
                'amount' => $this->cleanAmount($row['Subsequent temporary application charge']),
                'notes' => 'For subsequent temporary applications'
            ];
        }

        return $costs;
    }

    /**
     * Clean and format amount
     */
    private function cleanAmount(string $amount): string
    {
        // Remove quotes and extra spaces
        $amount = trim($amount, '"\'');
        
        // If it's N/A, return as is
        if (strtoupper($amount) === 'N/A') {
            return 'N/A';
        }
        
        // If it already has AUD, return as is
        if (stripos($amount, 'AUD') !== false) {
            return trim($amount);
        }
        
        // If it's just a number, add AUD prefix
        if (preg_match('/^\d+([.,]\d+)?$/', $amount)) {
            return 'AUD' . $amount;
        }
        
        return $amount;
    }

    /**
     * Check if costs have changed
     */
    private function costsHaveChanged($currentCosts, array $newCosts): bool
    {
        if (!$currentCosts || !is_array($currentCosts)) {
            return !empty($newCosts);
        }

        // Normalize arrays for comparison
        $current = $this->normalizeCostsArray($currentCosts);
        $new = $this->normalizeCostsArray($newCosts);

        return $current !== $new;
    }

    /**
     * Normalize costs array for comparison
     */
    private function normalizeCostsArray(array $costs): array
    {
        $normalized = [];
        foreach ($costs as $cost) {
            if (is_array($cost) && !empty($cost['label']) && !empty($cost['amount'])) {
                $normalized[] = [
                    'label' => trim($cost['label']),
                    'amount' => trim($cost['amount']),
                    'notes' => trim($cost['notes'] ?? '')
                ];
            }
        }
        return $normalized;
    }
}
