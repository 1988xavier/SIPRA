<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use Illuminate\Http\Request;

class CarreraController extends Controller
{
    // ================================================
    // ✅ Mostrar listado público de carreras + calendario
    // ================================================
    public function publicIndex()
    {
        // Carreras activas
        $carreras = Carrera::where('activo', true)->orderBy('nombre')->get();

        // ==============================
        // ✅ CALENDARIO PARA ASPIRANTES
        // ==============================
        $mes = request('mes', now()->month);
        $anio = request('anio', now()->year);

        $inicio = \Carbon\Carbon::create($anio, $mes, 1);
        $fin = $inicio->copy()->endOfMonth();

        $eventos = \App\Models\EventoAspirante::whereBetween('fecha', [
            $inicio->toDateString(),
            $fin->toDateString()
        ])->get();

        $proximos = \App\Models\EventoAspirante::where('fecha', '>=', now()->toDateString())
                    ->orderBy('fecha', 'asc')
                    ->limit(5)
                    ->get();

        return view('carreras.index', compact(
            'carreras',
            'inicio',
            'fin',
            'mes',
            'eventos',
            'proximos'
        ));
    }

    // ================================================
    // ✅ Mostrar detalle público de una carrera
    // ================================================
    public function showPublic(Carrera $carrera)
    {
        // Contador de vistas
        $carrera->increment('vistas');

        return view('carreras.show', compact('carrera'));
    }



    // ================================================
    // ✅ Listado para aspirantes (esto no se toca)
    // ================================================
    public function listadoAspirantes()
    {
        $carreras = Carrera::where('activo', true)->get();
        return view('aspirantes.carreras.index', compact('carreras'));
    }




    
}
