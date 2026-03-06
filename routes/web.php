<?php

use Illuminate\Support\Facades\Route;

// Redirect to admin panel
Route::redirect('/', '/admin');

//Protected routes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // principal view
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

