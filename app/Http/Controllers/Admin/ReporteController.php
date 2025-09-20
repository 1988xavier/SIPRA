<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carrera;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function index()
    {
        // carreras para los selects
        $carreras = Carrera::orderBy('nombre')->get();

        // datos de ejemplo para historial (luego se guardarán en DB si quieres)
        $historial = [
            [
                'tipo' => 'Lista de Aspirantes',
                'fecha' => '2024-05-15 10:30 AM',
                'formato' => 'Excel',
            ],
        ];

        return view('admin.reportes.index', compact('carreras', 'historial'));
    }
}
