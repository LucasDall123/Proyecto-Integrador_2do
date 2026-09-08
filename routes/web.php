<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\RepuestoController;
use App\Http\Controllers\PublicTrackingController;
use Illuminate\Support\Facades\Route;

// Rutas públicas (sin autenticación)
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

Route::get('/tracking', [PublicTrackingController::class, 'index'])->name('tracking.index');

// Rutas de autenticación
require __DIR__.'/auth.php';

// Rutas protegidas para técnicos (requieren autenticación y rol técnico)
Route::middleware(['auth', 'verified', 'tecnico'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Clientes routes
    Route::resource('clientes', ClienteController::class);

    // Equipos routes
    Route::resource('equipos', EquipoController::class);

    // Ordenes routes
    Route::resource('ordenes', OrdenController::class);
    Route::post('/ordenes/{orden}/repuestos', [OrdenController::class, 'addRepuesto'])->name('ordenes.addRepuesto');
});

// Rutas protegidas para administradores (requieren autenticación y rol admin)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/repuestos', [RepuestoController::class, 'index'])->name('repuestos.index');
    Route::patch('/repuestos/{repuesto}', [RepuestoController::class, 'updateStatus'])->name('repuestos.updateStatus');
});

// Rutas protegidas para cualquier usuario autenticado
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
