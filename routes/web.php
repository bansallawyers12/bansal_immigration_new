<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;

// Main pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/ourservices', [HomeController::class, 'services'])->name('services');
Route::get('/services/{slug}', [HomeController::class, 'serviceDetail'])->name('service.detail');
Route::get('/blogs', [HomeController::class, 'blogs'])->name('blogs');
Route::get('/blogs/{slug}', [HomeController::class, 'blogDetail'])->name('blog.detail');
Route::get('/book-an-appointment', [HomeController::class, 'appointment'])->name('appointment');
Route::post('/book-an-appointment/store', [HomeController::class, 'storeAppointment'])->name('appointment.store');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'storeContact'])->name('contact.store');
Route::post('/contact/submit', [\App\Http\Controllers\ContactController::class, 'submit'])->name('contact.submit');

// Dashboard redirect route (Laravel default after login)
Route::middleware(['auth'])->get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->name('dashboard');

// Admin Routes (protected by auth middleware and verified user)
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/contacts', [\App\Http\Controllers\AdminController::class, 'contacts'])->name('contacts');
    Route::get('/contacts/{contact}', [\App\Http\Controllers\AdminController::class, 'showContact'])->name('contacts.show');
    Route::patch('/contacts/{contact}/status', [\App\Http\Controllers\AdminController::class, 'updateContactStatus'])->name('contacts.update-status');
    Route::get('/enquiries', [\App\Http\Controllers\AdminController::class, 'enquiries'])->name('enquiries');
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
});

// Include specialized route files
require __DIR__.'/visa-routes.php';
require __DIR__.'/utility-routes.php';
require __DIR__.'/auth.php';