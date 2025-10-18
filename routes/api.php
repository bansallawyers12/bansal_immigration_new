<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CalendarController;
use App\Http\Controllers\Api\HomeApiController;
use App\Http\Controllers\Api\AppointmentApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public API routes for home page content
Route::prefix('home')->group(function () {
    Route::get('/statistics', [HomeApiController::class, 'getStatistics']);
    Route::get('/latest-blogs', [HomeApiController::class, 'getLatestBlogs']);
    Route::get('/services', [HomeApiController::class, 'getServices']);
    Route::get('/success-stories', [HomeApiController::class, 'getSuccessStories']);
    Route::get('/testimonials', [HomeApiController::class, 'getTestimonials']);
    Route::get('/search', [HomeApiController::class, 'search']);
    Route::post('/newsletter', [HomeApiController::class, 'subscribeNewsletter']);
});

// Public API routes for appointment booking
Route::prefix('appointments')->group(function () {
    // Get available time slots for a specific date and enquiry type
    Route::get('/available-slots', [CalendarController::class, 'getAvailableSlots']);
    
    // Get calendar events (appointments and blocked times)
    Route::get('/calendar-events', [CalendarController::class, 'getCalendarEvents']);
});

// Admin API routes (protected by auth middleware)
Route::middleware(['auth:sanctum'])->prefix('admin')->group(function () {
    // Appointment management API
    Route::prefix('appointments')->group(function () {
        Route::get('/calendar', [\App\Http\Controllers\AppointmentController::class, 'calendar']);
        Route::get('/available-slots', [\App\Http\Controllers\AppointmentController::class, 'getAvailableTimeSlots']);
    });
    
    // Blocked times management API
    Route::prefix('blocked-times')->group(function () {
        Route::get('/calendar', [\App\Http\Controllers\BlockedTimeController::class, 'calendar']);
    });
});

// CRM Integration API routes (protected by API authentication)
Route::middleware(['auth:sanctum', 'throttle:60,1'])->prefix('crm')->group(function () {
    // Appointments API for CRM
    Route::prefix('appointments')->group(function () {
        Route::get('/', [AppointmentApiController::class, 'index']);
        Route::get('/export', [AppointmentApiController::class, 'export']);
        Route::get('/recent', [AppointmentApiController::class, 'recent']);
        Route::get('/stats', [AppointmentApiController::class, 'stats']);
        Route::get('/{id}', [AppointmentApiController::class, 'show']);
    });
});
