<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use Illuminate\Http\Request;

class CarreraController extends Controller
{
    // Mostrar listado público de carreras
    public function publicIndex()
    {
        $carreras = Carrera::where('activo', true)->orderBy('nombre')->get();
        return view('carreras.index', compact('carreras'));
    }

    // Mostrar detalle de una carrera en público
    public function showPublic(Carrera $carrera)
    {
        $carrera->increment('vistas');
        return view('carreras.show', compact('carrera'));
    }


    public function listadoAspirantes()
    {
        $carreras = \App\Models\Carrera::where('activo', true)->get();
        return view('aspirantes.carreras.index', compact('carreras'));
    }

}
