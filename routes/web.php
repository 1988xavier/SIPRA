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
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CalendarioAspiranteController;

use App\Http\Controllers\Auth\AspiranteAuthController;

// ========================================
// HOME → LOGIN
// ========================================
Route::get('/', function () {
    return redirect()->route('login');
});

// ========================================
// RUTAS PÚBLICAS
// ========================================

// Carreras
Route::get('/carreras', [CarreraController::class, 'publicIndex'])
    ->name('carreras.index.public');

Route::get('/carreras/{carrera:slug}', [CarreraController::class, 'showPublic'])
    ->name('carreras.show.public');

// Pre-registro público
Route::get('/pre-registro', [AspiranteController::class, 'create'])
    ->name('aspirantes.create.public');

Route::post('/pre-registro', [AspiranteController::class, 'store'])
    ->name('aspirantes.store.public');

// Login aspirantes
Route::get('/aspirantes/login', function () {
    return view('auth.login_aspirante');
})->name('aspirantes.login');

Route::post('/aspirantes/login', [AspiranteAuthController::class, 'login'])
    ->name('aspirantes.login.submit');

// ========================================
// ASPIRANTES (solo visualización)
// ========================================
Route::middleware(['auth.aspirante'])->group(function () {
    Route::get('/aspirantes/carreras', [CarreraController::class, 'listadoAspirantes'])
        ->name('aspirantes.carreras');

    Route::post('/aspirantes/logout', [AspiranteAuthController::class, 'logout'])
        ->name('aspirantes.logout');
});

// ========================================
// USUARIOS LOGUEADOS
// ========================================
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('verified')
        ->name('dashboard');

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

// ========================================
// ADMINISTRADORES
// ========================================
Route::middleware(['auth', 'verified', 'is_admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Aspirantes
        Route::resource('aspirantes', AspiranteAdminController::class);

        // Cambiar estado de aspirante
        Route::patch('/aspirantes/{aspirante}/status',
            [AspiranteAdminController::class, 'updateStatus'])
            ->name('aspirantes.updateStatus');

        // Enviar correo
        Route::post('/aspirantes/{aspirante}/correo',
            [AspiranteAdminController::class, 'enviarCorreo'])
            ->name('aspirantes.enviarCorreo');

        // Carreras
        Route::resource('carreras', CarreraAdminController::class);

        // Eliminar multimedia
        Route::delete('/carreras/multimedia/{media}',
            [CarreraAdminController::class, 'destroyMultimedia'])
            ->name('carreras.multimedia.destroy');

        // Administradores y coordinadores
        Route::resource('administradores', AdministradorController::class)
            ->except(['show', 'edit', 'update']);

        Route::patch('/administradores/{user}/estado',
            [AdministradorController::class, 'updateEstado'])
            ->name('administradores.updateEstado');

        // Reportes
        Route::get('/reportes', [ReporteController::class, 'index'])
            ->name('reportes.index');

        Route::post('/reportes/exportar', [ReporteController::class, 'exportar'])
            ->name('reportes.exportar');

        // Calendario UPB
        Route::get('/calendario', [CalendarioController::class, 'index'])
            ->name('calendario.index');

        Route::post('/calendario', [CalendarioController::class, 'store'])
            ->name('calendario.store');

        // Calendario aspirantes
        Route::get('/calendario-aspirantes', [CalendarioAspiranteController::class, 'index'])
            ->name('calendario_aspirantes.index');

        Route::post('/calendario-aspirantes', [CalendarioAspiranteController::class, 'store'])
            ->name('calendario_aspirantes.store');
    });

// ========================================
// COORDINADORES
// ========================================
Route::middleware(['auth', 'verified'])
    ->prefix('coordinador')
    ->name('coordinador.')
    ->group(function () {

        Route::get('/reportes', [ReporteController::class, 'index'])
            ->name('reportes.index');

        Route::get('/calendario', [CalendarioController::class, 'index'])
            ->name('calendario.index');
    });

// ========================================
// MÓDULOS PÚBLICOS EXTRA
// ========================================

// Calendario académico público
Route::get('/calendario-academico', 
    [\App\Http\Controllers\CalendarioAspirantePublicController::class, 'index'])
    ->name('calendario.academico');

// Página QR bienvenida
Route::get('/bienvenida', function () {
    return view('aspirantes.bienvenida');
})->name('aspirantes.bienvenida');

// Pre-registro desde carrera
Route::get('/pre-registro/{carrera}', [AspiranteController::class, 'form'])
    ->name('pre.registro');

Route::post('/pre-registro/guardar', [AspiranteController::class, 'guardar'])
    ->name('pre.registro.guardar');

Route::get('/pre-registro-exitoso', [AspiranteController::class, 'exito'])
    ->name('pre.registro.exito');

// Aviso privacidad
Route::get('/aviso-privacidad', function () {
    return view('aviso-privacidad');
})->name('aviso.privacidad');







// Ciclos de promoción
Route::get('/ciclos/historial', [App\Http\Controllers\CicloPromocionController::class, 'historial'])
    ->name('ciclos.historial');

Route::get('/ciclos/{id}', [App\Http\Controllers\CicloPromocionController::class, 'verCiclo'])
    ->name('ciclos.detalle');

// Acciones
Route::post('/ciclos/iniciar', [App\Http\Controllers\CicloPromocionController::class, 'iniciarCiclo'])
    ->name('ciclos.iniciar');

Route::post('/ciclos/cerrar', [App\Http\Controllers\CicloPromocionController::class, 'cerrarCiclo'])
    ->name('ciclos.cerrar');



require __DIR__.'/auth.php';
