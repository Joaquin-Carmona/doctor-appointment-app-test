<?php

use Illuminate\Support\Facades\Route;

// Ruta principal del panel de administración
Route::get('/', function(){
    return view('admin.dashboard');
})->name('dashboard');

// Gestión de roles y permisos
Route::resource('roles',\App\Http\Controllers\Admin\RoleController::class);

// Gestión de usuarios del sistema
Route::resource('users',\App\Http\Controllers\Admin\UserController::class);

// Gestión de pacientes
Route::resource('patients',\App\Http\Controllers\Admin\PatientController::class);

// Gestión de doctores
Route::resource('doctors',\App\Http\Controllers\Admin\DoctorController::class);

// Gestión de tickets de soporte
Route::resource('support-tickets',\App\Http\Controllers\Admin\SupportTicketController::class);
