<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\AspiranteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AspiranteAdminController;
use App\Http\Controllers\Admin\ReporteController;
use App\Http\Controllers\Admin\AdministradorController;
use App\Http\Controllers\Admin\CalendarioController;
use App\Http\Controllers\Admin\CarreraAdminController;
use App\Http\Controllers\Auth\AspiranteAuthController;

// Página principal -> redirige al login
Route::get('/', function () {
    return redirect()->route('login');
});

// ========================================
// RUTAS PÚBLICAS
// ========================================

// Carreras públicas
Route::get('/carreras', [CarreraController::class, 'publicIndex'])->name('carreras.index.public');
Route::get('/carreras/{carrera:slug}', [CarreraController::class, 'showPublic'])->name('carreras.show.public');

// Pre-registro de aspirantes (PÚBLICO)
Route::get('/pre-registro', [AspiranteController::class, 'create'])->name('aspirantes.create.public');
Route::post('/pre-registro', [AspiranteController::class, 'store'])->name('aspirantes.store.public');

// Login de aspirantes (PÚBLICO)
Route::get('/aspirantes/login', function () {
    return view('auth.login_aspirante');
})->name('aspirantes.login');

Route::post('/aspirantes/login', [AspiranteAuthController::class, 'login'])
    ->name('aspirantes.login.submit');

// ========================================
// RUTAS PROTEGIDAS - ASPIRANTES
// ========================================

Route::middleware(['auth.aspirante'])->group(function () {
    // Área de aspirantes (solo visualización)
    Route::get('/aspirantes/carreras', [CarreraController::class, 'listadoAspirantes'])
        ->name('aspirantes.carreras');
    
    Route::post('/aspirantes/logout', [AspiranteAuthController::class, 'logout'])
        ->name('aspirantes.logout');
});

// ========================================
// RUTAS PROTEGIDAS - USUARIOS GENERALES
// ========================================

// Dashboard (para cualquier usuario logueado/verificado)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Perfil de usuario
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ========================================
// RUTAS PROTEGIDAS - ADMINISTRADORES
// ========================================

Route::middleware(['auth', 'verified', 'is_admin'])->prefix('admin')->group(function () {
    // Gestión de aspirantes
    Route::resource('aspirantes', AspiranteAdminController::class);
    
    // Gestión de carreras
    Route::resource('carreras', CarreraAdminController::class);
    
    // Gestión de administradores
    Route::resource('administradores', AdministradorController::class)->except(['show', 'edit', 'update']);
    Route::patch('/administradores/{user}/estado', [AdministradorController::class, 'updateEstado'])
        ->name('administradores.updateEstado');
    
    // Reportes
    Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');
    
    // Calendario
    Route::get('/calendario', [CalendarioController::class, 'index'])->name('calendario.index');
    Route::post('/calendario', [CalendarioController::class, 'store'])->name('calendario.store');
});

require __DIR__.'/auth.php';
