<?php

namespace App\Http\Controllers;

use App\Models\EventoAspirante;
use Carbon\Carbon;

class CalendarioAspirantePublicController extends Controller
{
    public function index()
    {
        $eventos = EventoAspirante::orderBy('fecha')->get();
        return view('aspirantes.calendario', compact('eventos'));
    }
}
