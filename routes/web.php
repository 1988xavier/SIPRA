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
use App\Http\Controllers\Admin\DashboardController;

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
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

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
    Route::resource('aspirantes', AspiranteAdminController::class)
        ->names('admin.aspirantes');
    
    // Gestión de carreras
    Route::resource('carreras', CarreraAdminController::class)
        ->names('admin.carreras');

    // Eliminar multimedia individual
    Route::delete('/carreras/multimedia/{media}', [CarreraAdminController::class, 'destroyMultimedia'])
        ->name('admin.carreras.multimedia.destroy');
    
    // Gestión de administradores
    Route::resource('administradores', AdministradorController::class)
        ->except(['show', 'edit', 'update'])
        ->names('admin.administradores');
    Route::patch('/administradores/{user}/estado', [AdministradorController::class, 'updateEstado'])
        ->name('admin.administradores.updateEstado');

    // Reportes
    Route::get('/reportes', [ReporteController::class, 'index'])->name('admin.reportes.index');

    // Calendario
    Route::get('/calendario', [CalendarioController::class, 'index'])->name('admin.calendario.index');
    Route::post('/calendario', [CalendarioController::class, 'store'])->name('admin.calendario.store');

    // 📅 Nuevo: Calendario de aspirantes
Route::get('/calendario-aspirantes', [CalendarioAspiranteController::class, 'index'])->name('admin.calendario_aspirantes.index');
Route::post('/calendario-aspirantes', [CalendarioAspiranteController::class, 'store'])->name('admin.calendario_aspirantes.store');

// Calendario de aspirantes (nuevo)
Route::get('/calendario-aspirantes', [\App\Http\Controllers\Admin\CalendarioAspiranteController::class, 'index'])
    ->name('admin.calendario_aspirantes.index');
Route::post('/calendario-aspirantes', [\App\Http\Controllers\Admin\CalendarioAspiranteController::class, 'store'])
    ->name('admin.calendario_aspirantes.store');

});

// Reportes
Route::get('/reportes', [ReporteController::class, 'index'])->name('admin.reportes.index');
Route::post('/reportes/exportar', [ReporteController::class, 'exportar'])->name('admin.reportes.exportar');

// web.php
Route::patch('/admin/aspirantes/{aspirante}/status', [AspiranteAdminController::class, 'updateStatus'])->name('admin.aspirantes.updateStatus');



Route::delete('/admin/aspirantes/{aspirante}', [AspiranteAdminController::class, 'destroy'])
     ->name('admin.aspirantes.destroy');




     Route::post('/admin/aspirantes/{aspirante}/correo', [AspiranteAdminController::class, 'enviarCorreo'])
    ->name('admin.aspirantes.enviarCorreo');



    Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('reportes', [\App\Http\Controllers\Admin\ReporteController::class, 'index'])->name('reportes.index');
    Route::post('reportes/exportar', [\App\Http\Controllers\Admin\ReporteController::class, 'exportar'])->name('reportes.exportar');
});



// ========================================
// RUTAS PARA COORDINADORES
// ========================================
Route::middleware(['auth', 'verified'])
    ->prefix('coordinador')
    ->name('coordinador.')
    ->group(function () {

        // Reportes (solo lectura)
        Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');

        // Calendario (solo lectura)
        Route::get('/calendario', [CalendarioController::class, 'index'])->name('calendario.index');
    });


Route::get('/calendario-academico', [\App\Http\Controllers\CalendarioAspirantePublicController::class, 'index'])
    ->name('calendario.academico');


    // Página de bienvenida para QR
Route::get('/bienvenida', function () {
    return view('aspirantes.bienvenida');
})->name('aspirantes.bienvenida');



// Pre-registro de aspirante desde una carrera
Route::get('/pre-registro/{carrera}', [AspiranteController::class, 'form'])
    ->name('pre.registro');

Route::post('/pre-registro/guardar', [AspiranteController::class, 'guardar'])
    ->name('pre.registro.guardar');   




Route::get('/pre-registro-exitoso', [AspiranteController::class, 'exito'])
    ->name('pre.registro.exito');


require __DIR__.'/auth.php';
