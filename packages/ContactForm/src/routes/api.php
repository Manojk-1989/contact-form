<?php

use Illuminate\Support\Facades\Route;
use ContactForm\Http\Controllers\ContactController;
use ContactForm\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware;

// ------------------------
// User API Routes
// ------------------------
Route::middleware(['auth:api'])->group(function () {
    // Submit contact form
    Route::post('/contact-submit', [ContactController::class, 'store']);

    // Get user's own submissions
    Route::get('/my-submissions', [ContactController::class, 'mySubmissions']);
});

// ------------------------
// Admin API Routes
// ------------------------
Route::middleware(['auth:api', AdminMiddleware::class])->prefix('admin')->group(function () {
    // Get all contact submissions (admin only)
    Route::get('/contact-submissions', [AdminController::class, 'index']);
});
