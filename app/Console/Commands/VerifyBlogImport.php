<?php

namespace App\Console\Commands;

use App\Models\Blog;
use Illuminate\Console\Command;

class VerifyBlogImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'verify:blog-import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verify the blog import results';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== Blog Import Verification ===');
        
        $totalBlogs = Blog::count();
        $publishedBlogs = Blog::published()->count();
        $featuredBlogs = Blog::featured()->count();
        
        $this->info("Total blogs: {$totalBlogs}");
        $this->info("Published blogs: {$publishedBlogs}");
        $this->info("Featured blogs: {$featuredBlogs}");
        
        $this->newLine();
        $this->info('Latest 5 blog records:');
        $this->line(str_repeat('-', 80));
        
        $blogs = Blog::latest()->take(5)->get();
        
        foreach ($blogs as $blog) {
            $this->line("ID: {$blog->id}");
            $this->line("Title: {$blog->title}");
            $this->line("Slug: {$blog->slug}");
            $this->line("Status: " . ($blog->status ? 'Active' : 'Inactive'));
            $this->line("Featured: " . ($blog->featured ? 'Yes' : 'No'));
            $this->line("Author: {$blog->author}");
            $this->line("Created: {$blog->created_at}");
            $this->line(str_repeat('-', 80));
        }
        
        $this->newLine();
        $this->info('✅ Blog import verification completed!');
        
        return 0;
    }
}
