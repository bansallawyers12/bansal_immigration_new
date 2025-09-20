<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Appointment Routes
|--------------------------------------------------------------------------
|
| All appointment-related routes including public booking, admin management,
| and payment processing.
|
*/

// Public Appointment Routes
Route::prefix('appointments')->name('appointments.')->group(function () {
    // Public booking form
    Route::get('/book', [AppointmentController::class, 'showBookingForm'])->name('book');
    Route::post('/book', [AppointmentController::class, 'store'])->name('store');
    
    // Public appointment details (with token)
    Route::get('/{appointment}/details', [AppointmentController::class, 'showPublic'])->name('show');
    Route::post('/{appointment}/confirm', [AppointmentController::class, 'confirmPublic'])->name('confirm');
    Route::post('/{appointment}/cancel', [AppointmentController::class, 'cancelPublic'])->name('cancel');
    
    // Public appointment success page
    Route::get('/{appointment}/success', [AppointmentController::class, 'success'])->name('success');
});

// Payment Routes
Route::prefix('payments')->name('payments.')->group(function () {
    Route::get('/{appointment}', [PaymentController::class, 'show'])->name('show');
    Route::post('/{appointment}/process', [PaymentController::class, 'process'])->name('process');
    Route::get('/{appointment}/success', [PaymentController::class, 'success'])->name('success');
    Route::get('/{appointment}/cancel', [PaymentController::class, 'cancel'])->name('cancel');
    Route::post('/validate-promo', [PaymentController::class, 'validatePromoCode'])->name('validate-promo');
});

// Admin Appointment Routes
Route::middleware(['auth', 'verified'])->prefix('admin/appointments')->name('admin.appointments.')->group(function () {
    // CRUD Operations
    Route::get('/', [AppointmentController::class, 'index'])->name('index');
    Route::get('/create', [AppointmentController::class, 'create'])->name('create');
    Route::post('/', [AppointmentController::class, 'store'])->name('store');
    Route::get('/{appointment}', [AppointmentController::class, 'show'])->name('show');
    Route::get('/{appointment}/edit', [AppointmentController::class, 'edit'])->name('edit');
    Route::put('/{appointment}', [AppointmentController::class, 'update'])->name('update');
    Route::delete('/{appointment}', [AppointmentController::class, 'destroy'])->name('destroy');
    
    // Status Management
    Route::post('/{appointment}/confirm', [AppointmentController::class, 'confirm'])->name('confirm');
    Route::post('/{appointment}/cancel', [AppointmentController::class, 'cancel'])->name('cancel');
    
    // Calendar Views
    Route::get('/calendar', [AppointmentController::class, 'calendar'])->name('calendar');
    Route::get('/calendar-view', function() { 
        return view('appointments.admin.calendar'); 
    })->name('calendar-view');
    Route::get('/weekly-calendar', function() { 
        return view('appointments.admin.weekly-calendar'); 
    })->name('weekly-calendar');
    
    // Payment Management
    Route::get('/{appointment}/payment', [PaymentController::class, 'showPayment'])->name('payment.show');
    Route::post('/payments/{payment}/refund', [PaymentController::class, 'refund'])->name('payment.refund');
});

// API Routes for AJAX calls
Route::prefix('api/appointments')->name('api.appointments.')->group(function () {
    Route::get('/available-slots', [AppointmentController::class, 'getAvailableTimeSlots'])->name('available-slots');
    Route::post('/validate-promo', [PaymentController::class, 'validatePromoCode'])->name('validate-promo');
});
