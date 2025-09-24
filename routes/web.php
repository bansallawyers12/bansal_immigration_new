<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;

// Main pages
Route::get('/', [HomeController::class, 'index'])->name('home');

// Test page for editor comparison
Route::get('/test-editors', function () {
    return view('test-editors');
})->name('test-editors');

// Test page for Slater & Gordon inspired design
Route::get('/test-slater-gordon', function () {
    return view('test-slater-gordon');
})->name('test-slater-gordon');

// Tailwind CSS comparison test pages
Route::get('/test-tailwind-comparison', function () {
    return view('test-tailwind-comparison');
})->name('test-tailwind-comparison');

Route::get('/test-vite', function () {
    return view('test-vite');
})->name('test-vite');
// Internal service design test page
Route::get('/design/service-test', function () {
    return view('pages.service-test');
})->name('design.service-test');
// Unique 485 visa detail design test page (with real DB content)
Route::get('/design/visa-485-test', function () {
    $page = \App\Models\Page::where('category', 'migration')
        ->where('slug', 'post-study-work-visa-subclass-485')
        ->active()
        ->first();
    return view('pages.visa-485-test', compact('page'));
})->name('design.visa-485-test');
// CMS advanced layout test (no backend changes, uses existing fields)
Route::get('/design/cms-advanced-test', function () {
    $page = \App\Models\Page::where('status', true)
        ->orderBy('id', 'desc')
        ->first();
    return view('pages.cms-advanced-test', compact('page'));
})->name('design.cms-advanced-test');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/blogs', [HomeController::class, 'blogs'])->name('blogs');
Route::get('/blogs/{slug}', [HomeController::class, 'blogDetail'])->name('blog.detail');
Route::get('/success-stories', [HomeController::class, 'successStories'])->name('success-stories');
Route::get('/success-stories/{slug}', [HomeController::class, 'successStoryDetail'])->name('success-story.detail');
// Legacy route for backward compatibility
Route::get('/book-an-appointment', [HomeController::class, 'appointment'])->name('appointment');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'storeContact'])->name('contact.store');
Route::post('/contact/submit', [\App\Http\Controllers\ContactController::class, 'submit'])->name('contact.submit');

// Cache management (for admin use)
Route::post('/clear-cache', [HomeController::class, 'clearCache'])->name('clear-cache');

// Dashboard redirect route (Laravel default after login)
Route::middleware(['auth'])->get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->name('dashboard');

// Admin route redirect to login
Route::get('/admin', function () {
    return redirect()->route('login');
});

// Admin Routes (protected by auth middleware and verified user)
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    // Contact Management Routes
    Route::get('/contacts', [\App\Http\Controllers\AdminController::class, 'contacts'])->name('contacts');
    Route::get('/contacts/{contact}', [\App\Http\Controllers\AdminController::class, 'showContact'])->name('contacts.show');
    Route::patch('/contacts/{contact}/status', [\App\Http\Controllers\AdminController::class, 'updateContactStatus'])->name('contacts.update-status');
    Route::post('/contacts/{contact}/forward', [\App\Http\Controllers\AdminController::class, 'forwardContact'])->name('contacts.forward');
    Route::patch('/contacts/{contact}/archive', [\App\Http\Controllers\AdminController::class, 'archiveContact'])->name('contacts.archive');
    Route::patch('/contacts/{contact}/unarchive', [\App\Http\Controllers\AdminController::class, 'unarchiveContact'])->name('contacts.unarchive');
    
    // Bulk Contact Actions
    Route::post('/contacts/bulk-status', [\App\Http\Controllers\AdminController::class, 'bulkUpdateContactStatus'])->name('contacts.bulk-status');
    Route::post('/contacts/bulk-forward', [\App\Http\Controllers\AdminController::class, 'bulkForwardContacts'])->name('contacts.bulk-forward');
    Route::post('/contacts/bulk-archive', [\App\Http\Controllers\AdminController::class, 'bulkArchiveContacts'])->name('contacts.bulk-archive');
    Route::post('/contacts/bulk-unarchive', [\App\Http\Controllers\AdminController::class, 'bulkUnarchiveContacts'])->name('contacts.bulk-unarchive');
    Route::get('/content', [\App\Http\Controllers\AdminController::class, 'content'])->name('content');
    Route::get('/settings', [\App\Http\Controllers\AdminController::class, 'settings'])->name('settings');
    Route::post('/settings', [\App\Http\Controllers\AdminController::class, 'updateSettings'])->name('settings.update');
    
    // User Management Routes
    Route::get('/users', [\App\Http\Controllers\AdminController::class, 'users'])->name('users');
    Route::get('/users/create', [\App\Http\Controllers\AdminController::class, 'createUser'])->name('users.create');
    Route::post('/users', [\App\Http\Controllers\AdminController::class, 'storeUser'])->name('users.store');
    Route::get('/users/{user}/edit', [\App\Http\Controllers\AdminController::class, 'editUser'])->name('users.edit');
    Route::patch('/users/{user}', [\App\Http\Controllers\AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{user}', [\App\Http\Controllers\AdminController::class, 'deleteUser'])->name('users.delete');
    
    // CMS Management Routes
    Route::resource('/cms', \App\Http\Controllers\Admin\AdminCmsController::class)->names('cms')->parameters(['cms' => 'page']);
    Route::patch('/cms/{page}/status', [\App\Http\Controllers\Admin\AdminCmsController::class, 'updateStatus'])->name('cms.update-status');
    Route::post('/cms/reorder', [\App\Http\Controllers\Admin\AdminCmsController::class, 'reorder'])->name('cms.reorder');
    
    // Blog Management Routes
    Route::resource('/blog', \App\Http\Controllers\Admin\AdminBlogController::class)->names('blog');
    Route::patch('/blog/{blog}/status', [\App\Http\Controllers\Admin\AdminBlogController::class, 'updateStatus'])->name('blog.update-status');
    Route::patch('/blog/{blog}/featured', [\App\Http\Controllers\Admin\AdminBlogController::class, 'toggleFeatured'])->name('blog.toggle-featured');
    
    // Success Stories Management Routes
    Route::resource('/success-stories', \App\Http\Controllers\Admin\AdminSuccessStoryController::class)->names('success-stories');
    Route::patch('/success-stories/{successStory}/status', [\App\Http\Controllers\Admin\AdminSuccessStoryController::class, 'updateStatus'])->name('success-stories.update-status');
    Route::patch('/success-stories/{successStory}/featured', [\App\Http\Controllers\Admin\AdminSuccessStoryController::class, 'toggleFeatured'])->name('success-stories.toggle-featured');
    Route::post('/success-stories/reorder', [\App\Http\Controllers\Admin\AdminSuccessStoryController::class, 'reorder'])->name('success-stories.reorder');
    // Blocked Times Management Routes
    Route::resource('/blocked-times', \App\Http\Controllers\BlockedTimeController::class)->names('blocked-times');
    Route::post('/blocked-times/{blockedTime}/toggle-active', [\App\Http\Controllers\BlockedTimeController::class, 'toggleActive'])->name('blocked-times.toggle-active');
    Route::get('/blocked-times-calendar', [\App\Http\Controllers\BlockedTimeController::class, 'calendar'])->name('blocked-times.calendar');
    
    // Promo Code Management Routes
    Route::resource('/promo-codes', \App\Http\Controllers\Admin\PromoCodeController::class)->names('promo-codes');
    Route::post('/promo-codes/{promoCode}/toggle-active', [\App\Http\Controllers\Admin\PromoCodeController::class, 'toggleActive'])->name('promo-codes.toggle-active');
    Route::post('/promo-codes/generate-code', [\App\Http\Controllers\Admin\PromoCodeController::class, 'generateCode'])->name('promo-codes.generate-code');
    Route::post('/promo-codes/test-calculation', [\App\Http\Controllers\Admin\PromoCodeController::class, 'testCalculation'])->name('promo-codes.test-calculation');
});

// Include specialized route files
require __DIR__.'/appointment-routes.php';
require __DIR__.'/visa-routes.php';
require __DIR__.'/utility-routes.php';
require __DIR__.'/auth.php';

// Dynamic page route - MUST be last to avoid conflicts
Route::get('{category}/{slug?}', [PageController::class, 'show'])
    ->where('category', '[a-z0-9-]+')
    ->where('slug', '[a-z0-9-]+')
    ->name('pages.dynamic');