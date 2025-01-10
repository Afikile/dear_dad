<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;

// Auth routes (default Laravel authentication)
Auth::routes(); 

// Public routes for letters (index and show)
Route::get('/letters', [LetterController::class, 'index'])->name('letters.index');
Route::get('/letters/{letter}', [LetterController::class, 'show'])->name('letters.show');

// Protect routes for logged-in and verified users
Route::middleware(['auth', 'verified'])->group(function () {
    // Letters Routes (create, store, edit, update, destroy)
    Route::resource('letters', LetterController::class)->except(['index', 'show']);
    
    // Comment Routes (for authenticated and verified users)
    Route::post('/letters/{letter}/comments', [CommentController::class, 'store'])->name('comments.store');
});

// Admin routes (if needed for admin control)
Route::middleware(['admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});

// Home route (Only define one home route, use '/')
Route::get('/', [LetterController::class, 'index'])->name('home');

// Logout route
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Dashboard route (accessible only to logged-in users)
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->middleware('auth')->name('dashboard');


