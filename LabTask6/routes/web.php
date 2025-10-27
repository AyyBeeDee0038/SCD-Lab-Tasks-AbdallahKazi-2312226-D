<?php

use App\Http\Controllers\EventController;

Route::get('/', [EventController::class, 'index'])->name('events.index');
Route::get('/events', [EventController::class, 'index']);
Route::get('/events/{id}', [EventController::class, 'details'])->name('events.details');

Route::get('/create', [EventController::class, 'create'])->name('events.create');
Route::post('/store', [EventController::class, 'store'])->name('events.store');

// Delete (POST) — simple and works in HTML forms
Route::post('/events/{id}/delete', [EventController::class, 'destroy'])->name('events.delete');

