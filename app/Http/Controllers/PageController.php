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
            $page = Page::where('category', $category)
                       ->whereNull('parent_id')
                       ->where('slug', $category)
                       ->active()
                       ->firstOrFail();
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

        return view($template, compact('page', 'relatedPages'));
    }

    private function getDefaultTemplate($category)
    {
        $templates = [
            'study-australia' => 'pages.study-australia',
            'visitor-visa' => 'pages.visitor-visa',
            'migration' => 'pages.migration',
            'family-visa' => 'pages.family-visa',
            'employee-sponsored' => 'pages.employee-sponsored',
            'business-visa' => 'pages.business-visa',
            'appeals' => 'pages.appeals',
            'citizenship' => 'pages.citizenship',
            'other-countries' => 'pages.other-countries',
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

    // Method for handling contact form submissions
    public function storeContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'tel' => 'nullable|string|max:20',
            'query' => 'required|string|max:2000',
        ]);

        // Create contact inquiry record
        \App\Models\ContactInquiry::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->tel,
            'subject' => 'Website Contact Form',
            'message' => $request->query,
            'status' => 'new'
        ]);

        // You can add email notification here
        // Mail::to('admin@bansalimmigration.com')->send(new ContactInquiry($data));
        
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you for your inquiry. We will contact you within 24 hours!'
            ]);
        }

        return redirect()->back()->with('success', 'Thank you for your inquiry. We will contact you within 24 hours!');
    }
}
