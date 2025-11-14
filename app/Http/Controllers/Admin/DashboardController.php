<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aspirante;
use App\Models\Carrera;
use App\Models\CicloPromocion;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtener el ciclo activo
        $cicloActivo = CicloPromocion::where('estado', 'activo')->first();

        // Si no hay ciclo activo, mostrar todo en 0
        if (!$cicloActivo) {
            return view('dashboard', [
                'registrados' => 0,
                'proceso' => 0,
                'contactados' => 0,
                'noRegistrados' => 0,
                'labelsCarreras' => [],
                'dataCarreras' => [],
                'labelsEstados' => ["Registrados", "En proceso", "Contactados", "No registrados"],
                'dataEstados' => [0, 0, 0, 0]
            ]);
        }

        // ==========================
        //  FILTRAR POR ciclo_id
        // ==========================

        // Contar aspirantes por estado, PERO SOLO del ciclo activo
        $registrados   = Aspirante::where('ciclo_id', $cicloActivo->id)
                                   ->where('status', 'registrado')->count();

        $proceso       = Aspirante::where('ciclo_id', $cicloActivo->id)
                                   ->where('status', 'proceso')->count();

        $contactados   = Aspirante::where('ciclo_id', $cicloActivo->id)
                                   ->where('status', 'contactado')->count();

        $noRegistrados = Aspirante::where('ciclo_id', $cicloActivo->id)
                                   ->where('status', 'no_registrado')->count();

        // Aspirantes por carrera (solo ciclo activo)
        $carreras = Carrera::withCount([
            'aspirantes' => function ($q) use ($cicloActivo) {
                $q->where('ciclo_id', $cicloActivo->id);
            }
        ])->get();

        $labelsCarreras = $carreras->pluck('nombre');
        $dataCarreras   = $carreras->pluck('aspirantes_count');

        // Dados para la gráfica circular
        $labelsEstados = ["Registrados", "En proceso", "Contactados", "No registrados"];
        $dataEstados   = [$registrados, $proceso, $contactados, $noRegistrados];

        return view('dashboard', compact(
            'registrados',
            'proceso',
            'contactados',
            'noRegistrados',
            'labelsCarreras',
            'dataCarreras',
            'labelsEstados',
            'dataEstados'
        ));
    }
}
