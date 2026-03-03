<?php

use Illuminate\Support\Facades\Route;

// Redireccionar la raíz al panel de administración
Route::redirect('/', '/admin');

// Rutas protegidas que requieren autenticación y verificación
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Vista principal del dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
