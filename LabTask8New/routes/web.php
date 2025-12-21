<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Default page redirects to login
Route::get('/', function () {
    return redirect('/login');
});

// Registration
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Email Verification Link
Route::get('/verify/{id}', [AuthController::class, 'verify'])->name('verify');

// Protected Routes (Session Handling)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});