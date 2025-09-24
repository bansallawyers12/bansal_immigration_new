<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostcodeController;

// Utility Routes
Route::get('/testimonials', [HomeController::class, 'testimonials'])->name('testimonials');
Route::get('/our-team', [HomeController::class, 'team'])->name('team');
Route::get('/why-choose-us', [HomeController::class, 'whyChoose'])->name('why-choose');
Route::get('/mission-vision', [HomeController::class, 'missionVision'])->name('mission-vision');
Route::get('/postcode-checker', [PageController::class, 'postcodeChecker'])->name('postcode-checker');
Route::get('/api/postcode/check', [PostcodeController::class, 'check'])->name('api.postcode.check');
Route::get('/api/postcode/suggest', [PostcodeController::class, 'suggest'])->name('api.postcode.suggest');

// Legal Pages
Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/terms-conditions', [HomeController::class, 'termsConditions'])->name('terms-conditions');
Route::get('/disclaimer', [HomeController::class, 'disclaimer'])->name('disclaimer');
Route::get('/cookie-policy', [HomeController::class, 'cookiePolicy'])->name('cookie-policy');
