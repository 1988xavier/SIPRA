<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aspirante;
use App\Models\Carrera;

class DashboardController extends Controller
{
    public function index()
    {
        // Contar aspirantes por estado
        $registrados   = Aspirante::where('status', 'registrado')->count();
        $proceso       = Aspirante::where('status', 'proceso')->count();
        $contactados   = Aspirante::where('status', 'contactado')->count();
        $noRegistrados = Aspirante::where('status', 'no_registrado')->count();

        // Aspirantes por carrera
        $carreras = Carrera::withCount('aspirantes')->get();
        $labelsCarreras = $carreras->pluck('nombre');
        $dataCarreras = $carreras->pluck('aspirantes_count');


   

        // Aspirantes por estado (para gráfica pie)
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
