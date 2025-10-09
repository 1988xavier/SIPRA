<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventoAspirante;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CalendarioAspiranteController extends Controller
{
    public function index(Request $request)
    {
        $mes = $request->input('mes', date('m'));
        $anio = $request->input('anio', date('Y'));

        $inicio = Carbon::create($anio, $mes, 1);
        $fin = $inicio->copy()->endOfMonth();

        $eventos = EventoAspirante::whereBetween('fecha', [$inicio, $fin])->get();

        $proximos = EventoAspirante::where('fecha', '>=', Carbon::today())
            ->orderBy('fecha', 'asc')
            ->take(5)
            ->get();

        return view('admin.calendario_aspirantes.index', compact('mes','anio','inicio','fin','eventos','proximos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'fecha' => 'required|date',
        ]);

        EventoAspirante::create($request->only('titulo','descripcion','fecha'));

        return redirect()->route('admin.calendario_aspirantes.index')
            ->with('success', 'Evento agregado correctamente');
    }
}
