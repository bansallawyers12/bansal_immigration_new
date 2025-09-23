<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Page;
use Illuminate\Support\Str;

class ImportCmsPages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:cms-pages {--dry-run : Show what would be imported without actually importing}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import CMS pages from the old bansal_immigration database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Starting CMS pages import...');
        
        // Check if we can connect to the old database
        try {
            $oldPages = DB::connection('bansal_immigration')->table('cms_pages')->get();
            $this->info("Found {$oldPages->count()} pages in the old database.");
        } catch (\Exception $e) {
            $this->error('Could not connect to old database: ' . $e->getMessage());
            return 1;
        }

        $isDryRun = $this->option('dry-run');
        
        if ($isDryRun) {
            $this->warn('DRY RUN MODE - No data will be imported');
            $this->newLine();
        }

        $importedCount = 0;
        $skippedCount = 0;
        $errors = [];

        // Create a progress bar
        $progressBar = $this->output->createProgressBar($oldPages->count());
        $progressBar->start();

        foreach ($oldPages as $oldPage) {
            try {
                // Check if page already exists
                $existingPage = Page::where('slug', $oldPage->slug)->first();
                if ($existingPage) {
                    $skippedCount++;
                    $progressBar->advance();
                    continue;
                }

                if (!$isDryRun) {
                    // Map old database fields to new Page model
                    $pageData = [
                        'title' => $oldPage->title,
                        'slug' => $oldPage->slug,
                        'content' => $oldPage->content,
                        'excerpt' => $this->generateExcerpt($oldPage->content),
                        'template' => 'default',
                        'category' => $this->detectCategory($oldPage->slug, $oldPage->title),
                        'subcategory' => null,
                        'image' => $this->processImage($oldPage->image),
                        'image_alt' => $oldPage->image_alt,
                        'meta_title' => $oldPage->meta_title,
                        'meta_description' => $oldPage->meta_description,
                        'meta_keywords' => $oldPage->meta_keyward, // Note: typo in old DB
                        'status' => $oldPage->status ?? 1,
                        'featured' => false,
                        'order' => $oldPage->id, // Use old ID as order
                        'parent_id' => null,
                        'youtube_url' => $oldPage->youtube_url,
                        'pdf_doc' => $this->processPdfDoc($oldPage->pdf_doc),
                        'created_at' => $oldPage->created_at,
                        'updated_at' => $oldPage->updated_at,
                    ];

                    // Create the page
                    Page::create($pageData);
                }

                $importedCount++;
                $progressBar->advance();

            } catch (\Exception $e) {
                $errors[] = "Error importing page ID {$oldPage->id}: " . $e->getMessage();
                $progressBar->advance();
            }
        }

        $progressBar->finish();
        $this->newLine(2);

        // Display results
        $this->info("Import completed!");
        $this->table(
            ['Metric', 'Count'],
            [
                ['Total pages in old DB', $oldPages->count()],
                ['Successfully imported', $importedCount],
                ['Skipped (already exist)', $skippedCount],
                ['Errors', count($errors)],
            ]
        );

        if (!empty($errors)) {
            $this->error('Errors encountered:');
            foreach ($errors as $error) {
                $this->line("  - {$error}");
            }
        }

        if ($isDryRun) {
            $this->warn('This was a dry run. Use --dry-run=false to actually import the data.');
        } else {
            $this->info('CMS pages have been successfully imported!');
        }

        return 0;
    }

    /**
     * Generate excerpt from content
     */
    private function generateExcerpt($content)
    {
        if (empty($content)) {
            return null;
        }

        // Strip HTML tags and get first 200 characters
        $text = strip_tags($content);
        return Str::limit($text, 200);
    }

    /**
     * Map old type to new category
     */
    private function mapCategory($type)
    {
        $categoryMap = [
            'study' => 'study-australia',
            'visitor' => 'visitor-visa',
            'migration' => 'migration',
            'family' => 'family-visa',
            'employee' => 'employer-sponsored',
            'business' => 'business-visa',
            'appeals' => 'appeals',
            'citizenship' => 'citizenship',
            'other' => 'other-countries',
        ];

        return $categoryMap[$type] ?? 'other-countries';
    }

    /**
     * Smart category detection based on slug and title
     */
    private function detectCategory($slug, $title)
    {
        $text = strtolower($slug . ' ' . $title);
        
        // Study Australia patterns
        if (preg_match('/\b(admission|coe|course|student|study|education|university|college|school|visa.*extension|visa.*journey|guardian.*visa|subsequent.*visa|professional.*year|defer.*studies|rpl|prior.*learning)\b/', $text)) {
            return 'study-australia';
        }
        
        // Visitor visa patterns
        if (preg_match('/\b(visitor|tourist|work.*holiday|holiday.*work|travel.*exemption|600|417|462)\b/', $text)) {
            return 'visitor-visa';
        }
        
        // Migration patterns
        if (preg_match('/\b(migration|graduate|skilled|independent|nominated|regional|485|189|190|887|491|191|skill.*assessment|acs|vetassess|ea.*assessment|job.*ready|pr.*point)\b/', $text)) {
            return 'migration';
        }
        
        // Family visa patterns
        if (preg_match('/\b(family|partner|parent|child|spouse|marriage|prospective|contributory|aged.*parent|remaining.*relative|orphan|dependent.*child|carer)\b/', $text)) {
            return 'family-visa';
        }
        
        // Employer sponsored patterns
        if (preg_match('/\b(employee|sponsored|employer|tss|482|186|dama|global.*talent|gti|gtes|distinguished.*talent|temporary.*activity|408|400)\b/', $text)) {
            return 'employer-sponsored';
        }
        
        // Business visa patterns
        if (preg_match('/\b(business|investment|innovation|entrepreneur|investor|188|888|132|talent)\b/', $text)) {
            return 'business-visa';
        }
        
        // Appeals patterns
        if (preg_match('/\b(appeal|refusal|cancellation|waiver|work.*rights|study.*rights|notice.*cancellation)\b/', $text)) {
            return 'appeals';
        }
        
        // Citizenship patterns
        if (preg_match('/\b(citizenship|conferral|descent|evidence.*citizenship)\b/', $text)) {
            return 'citizenship';
        }
        
        return 'other-countries';
    }

    /**
     * Process image path
     */
    private function processImage($image)
    {
        if (empty($image)) {
            return null;
        }

        // If image already has storage path, return as is
        if (str_starts_with($image, 'storage/')) {
            return $image;
        }

        // Convert old image path to new storage path
        return 'storage/' . $image;
    }

    /**
     * Process PDF document path
     */
    private function processPdfDoc($pdfDoc)
    {
        if (empty($pdfDoc)) {
            return null;
        }

        // If document already has storage path, return as is
        if (str_starts_with($pdfDoc, 'storage/')) {
            return $pdfDoc;
        }

        // Convert old document path to new storage path
        return 'storage/' . $pdfDoc;
    }
}
