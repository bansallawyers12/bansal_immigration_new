<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Page;
use Illuminate\Support\Str;

class VerifyCmsImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'verify:cms-import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verify the CMS pages import results';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Verifying CMS pages import...');
        
        $totalPages = Page::count();
        $activePages = Page::where('status', 1)->count();
        $inactivePages = Page::where('status', 0)->count();
        $featuredPages = Page::where('featured', 1)->count();
        
        $this->table(
            ['Metric', 'Count'],
            [
                ['Total Pages', $totalPages],
                ['Active Pages', $activePages],
                ['Inactive Pages', $inactivePages],
                ['Featured Pages', $featuredPages],
            ]
        );

        $this->newLine();
        $this->info('Recent imported pages:');
        
        $recentPages = Page::latest()->take(10)->get(['id', 'title', 'slug', 'category', 'status']);
        
        $this->table(
            ['ID', 'Title', 'Slug', 'Category', 'Status'],
            $recentPages->map(function ($page) {
                return [
                    $page->id,
                    Str::limit($page->title, 40),
                    $page->slug,
                    $page->category ?? 'N/A',
                    $page->status ? 'Active' : 'Inactive'
                ];
            })
        );

        $this->newLine();
        $this->info('Categories distribution:');
        
        $categories = Page::selectRaw('category, COUNT(*) as count')
            ->groupBy('category')
            ->orderBy('count', 'desc')
            ->get();
            
        $this->table(
            ['Category', 'Count'],
            $categories->map(function ($item) {
                return [$item->category ?? 'N/A', $item->count];
            })
        );

        $this->newLine();
        $this->info('Import verification completed!');
        
        return 0;
    }
}
