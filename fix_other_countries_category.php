<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Page;

echo "=== FIXING OTHER-COUNTRIES CATEGORY ===\n\n";

// Check current other-countries pages
echo "Current other-countries pages:\n";
$otherCountriesPages = Page::where('category', 'other-countries')->get(['id', 'title', 'slug', 'category']);

foreach ($otherCountriesPages as $page) {
    echo "- ID {$page->id}: {$page->title} (slug: {$page->slug})\n";
}

echo "\n=== MOVING TO VISITOR-VISA CATEGORY ===\n";

// Move all other-countries pages to visitor-visa category
$updated = Page::where('category', 'other-countries')->update(['category' => 'visitor-visa']);

echo "✅ Updated {$updated} pages from 'other-countries' to 'visitor-visa'\n";

// Verify the change
echo "\n=== VERIFICATION ===\n";
$visitorVisaPages = Page::where('category', 'visitor-visa')->get(['id', 'title', 'slug', 'category']);

echo "Visitor-visa pages now include:\n";
foreach ($visitorVisaPages as $page) {
    echo "- ID {$page->id}: {$page->title} (slug: {$page->slug})\n";
}

echo "\n=== CHECKING FOR OTHER-COUNTRIES CATEGORY ===\n";
$remainingOtherCountries = Page::where('category', 'other-countries')->count();
echo "Remaining other-countries pages: {$remainingOtherCountries}\n";

if ($remainingOtherCountries === 0) {
    echo "✅ All other-countries pages successfully moved to visitor-visa!\n";
} else {
    echo "❌ Some pages still in other-countries category\n";
}

echo "\n=== TESTING URLS ===\n";
echo "Testing visitor-visa URLs:\n";

// Test a few URLs
$testPages = Page::where('category', 'visitor-visa')->take(3)->get();
foreach ($testPages as $page) {
    $url = "http://127.0.0.1:8000/{$page->category}/{$page->slug}";
    echo "- {$url}\n";
}
