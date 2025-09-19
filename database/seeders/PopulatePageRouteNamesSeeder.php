<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class PopulatePageRouteNamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all pages that don't have route_name set
        $pages = Page::whereNull('route_name')->get();

        foreach ($pages as $page) {
            // Use the model's generateRouteName method to get the correct route name
            $routeName = $page->generateRouteName();
            
            // Update the page with the generated route name
            $page->update(['route_name' => $routeName]);
            
            $this->command->info("Updated page '{$page->title}' with route name: {$routeName}");
        }

        $this->command->info("Successfully updated " . $pages->count() . " pages with route names.");
    }
}