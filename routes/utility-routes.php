<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;

// Utility Routes
Route::get('/testimonials', [HomeController::class, 'testimonials'])->name('testimonials');
Route::get('/our-team', [HomeController::class, 'team'])->name('team');
Route::get('/why-choose-us', [HomeController::class, 'whyChoose'])->name('why-choose');
Route::get('/mission-vision', [HomeController::class, 'missionVision'])->name('mission-vision');
Route::get('/postcode-checker', [PageController::class, 'postcodeChecker'])->name('postcode-checker');

// Legal Pages
Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/terms-conditions', [HomeController::class, 'termsConditions'])->name('terms-conditions');
Route::get('/disclaimer', [HomeController::class, 'disclaimer'])->name('disclaimer');
Route::get('/cookie-policy', [HomeController::class, 'cookiePolicy'])->name('cookie-policy');
