<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController; // <--- This line is very important!

// Default user route (you can keep or remove this)
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// --- PASTE THESE ROUTES FOR YOUR ASSIGNMENT ---

// 1. GET (Read All)
Route::get('/students', [StudentController::class, 'index']);

// 2. POST (Create)
Route::post('/students', [StudentController::class, 'store']);

// 3. GET (Read Single)
Route::get('/students/{id}', [StudentController::class, 'show']);

// 4. PUT (Update)
Route::put('/students/{id}', [StudentController::class, 'update']);

// 5. DELETE (Delete)
Route::delete('/students/{id}', [StudentController::class, 'destroy']);