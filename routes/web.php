<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\UserRegistrationController;

// Logout Route
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware(['auth'])
    ->name('logout');

// Root route showing all letters
Route::get('/', [LetterController::class, 'index'])->name('letters.index');

// Dashboard route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Letter Routes
Route::middleware('auth')->group(function () {
    Route::get('/letters/create', [LetterController::class, 'create'])->name('letters.create');
    Route::post('/letters', [LetterController::class, 'store'])->name('letters.store');
    Route::get('/letters/{letter}/edit', [LetterController::class, 'edit'])->name('letters.edit');
    Route::put('/letters/{letter}', [LetterController::class, 'update'])->name('letters.update');
    Route::delete('/letters/{letter}', [LetterController::class, 'destroy'])->name('letters.destroy');
    Route::post('/letters/{letter}/toggle-lock', [LetterController::class, 'toggleLock'])->name('letters.toggleLock');
    Route::post('/letters/{letter}/push-up', [LetterController::class, 'pushUp'])->name('letters.pushUp');
});

// Public Letter Route
Route::get('/letters/{id}', [LetterController::class, 'show'])->name('letters.show');

// Comment Routes
Route::middleware('auth')->group(function () {
    Route::post('/letters/{letter}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

// Reply Routes
Route::middleware('auth')->group(function () {
    Route::post('/letters/{letter}/reply/{parentId?}', [ReplyController::class, 'store'])->name('replies.store');
    Route::delete('/replies/{id}', [ReplyController::class, 'destroy'])->name('replies.destroy');
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); // Using PATCH here
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Login Routes
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Register Route
Route::get('/register', [UserRegistrationController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [UserRegistrationController::class, 'register']);

Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
