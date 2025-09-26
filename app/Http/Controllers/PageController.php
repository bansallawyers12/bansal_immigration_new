<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function show($category, $slug = null)
    {
        // If no slug provided, show category index page
        if (!$slug) {
            // Try conventional index page where slug matches category
            $page = Page::where('category', $category)
                       ->whereNull('parent_id')
                       ->where('slug', $category)
                       ->active()
                       ->first();

            // Fallback: pick the first active top-level page within the category
            if (!$page) {
                $page = Page::where('category', $category)
                           ->whereNull('parent_id')
                           ->active()
                           ->orderBy('id')
                           ->firstOrFail();
            }
        } else {
            $page = Page::where('category', $category)
                       ->where('slug', $slug)
                       ->active()
                       ->firstOrFail();
        }

        // Get related pages in the same category
        $relatedPages = Page::where('category', $category)
                           ->where('id', '!=', $page->id)
                           ->active()
                           ->take(6)
                           ->get();

        // Determine template to use
        $template = $page->template ?: $this->getDefaultTemplate($category);

        // Force the new hub design for the migrate-to-australia index page
        if (!$slug && $category === 'migrate-to-australia') {
            $template = 'pages.migrate-to-australia';
        }
        
        // Ensure template has 'pages.' prefix if not already present
        if (!str_starts_with($template, 'pages.')) {
            $template = 'pages.' . $template;
        }

        return view($template, compact('page', 'relatedPages'));
    }

    public function showSubpage($category, $subcategory, $slug)
    {
        $page = Page::where('category', $category)
                   ->where('subcategory', $subcategory)
                   ->where('slug', $slug)
                   ->active()
                   ->firstOrFail();

        // Get related pages in the same subcategory
        $relatedPages = Page::where('category', $category)
                           ->where('subcategory', $subcategory)
                           ->where('id', '!=', $page->id)
                           ->active()
                           ->take(6)
                           ->get();

        $template = $page->template ?: $this->getDefaultTemplate($category);
        
        // Ensure template has 'pages.' prefix if not already present
        if (!str_starts_with($template, 'pages.')) {
            $template = 'pages.' . $template;
        }

        return view($template, compact('page', 'relatedPages'));
    }

    private function getDefaultTemplate($category)
    {
        $templates = [
            'study-australia' => 'pages.study-australia',
            'visitor-visa' => 'pages.visitor-visa',
            'migration' => 'pages.migration',
            'migrate-to-australia' => 'pages.migrate-to-australia',
            'family-visa' => 'pages.family-visa',
            'employer-sponsored' => 'pages.employer-sponsored',
            'business-visa' => 'pages.business-visa',
            'appeals' => 'pages.appeals',
            'citizenship' => 'pages.citizenship',
            'other-countries' => 'pages.other-countries',
            'celebrity-visas' => 'pages.celebrity-visas',
            'skill-assessment' => 'pages.skill-assessment',
            'transit-special-purpose' => 'pages.default',
            'medical-humanitarian' => 'pages.default',
            'maritime-crew' => 'pages.default',
            'bridging-return-visas' => 'pages.default',
        ];

        return $templates[$category] ?? 'pages.default';
    }

    // Specific methods for calculators and tools
    public function prPointCalculator()
    {
        return view('tools.pr-point-calculator');
    }

    public function postcodeChecker()
    {
        return view('tools.postcode-checker');
    }

    public function studentVisaCalculator()
    {
        return view('tools.student-visa-calculator');
    }

    // Method for handling contact form submissions - redirects to unified contact system
    public function storeContact(Request $request)
    {
        // Redirect to the unified contact form submission
        return app(\App\Http\Controllers\ContactController::class)->submit($request);
    }
}
