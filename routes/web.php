<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\VerifiedController;
use Illuminate\Http\Request;

Route::get('/', [LetterController::class, 'index']); // Home route

// Only one route definition for letters resource
Route::resource('letters', LetterController::class); // RESTful routes for letters
Route::post('/letters/{letter}/comments', [CommentController::class, 'store'])->name('comments.store'); // Route to store comments

Auth::routes(); // Remove if using custom authentication routes

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Email verification routes
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [VerifiedController::class, 'verify'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

// Resend email verification
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
});

// Protect routes for logged-in users and verified users
Route::middleware(['auth', 'verified'])->group(function () {
    // Letters Routes
    Route::resource('letters', LetterController::class);

    // Comment Routes
    Route::post('/letters/{letter}/comments', [CommentController::class, 'store'])->name('comments.store');
});

// Admin routes
Route::middleware(['admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});

// Logout route
//Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
