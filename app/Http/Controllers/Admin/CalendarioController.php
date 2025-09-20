<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Evento;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CalendarioController extends Controller
{
    public function index(Request $request)
    {
        $mes = $request->input('mes', date('m'));
        $anio = $request->input('anio', date('Y'));

        // Primer día del mes
        $inicio = Carbon::create($anio, $mes, 1);
        $fin = $inicio->copy()->endOfMonth();

        // Eventos del mes
        $eventos = Evento::whereBetween('fecha', [$inicio, $fin])->get();

        // Próximos eventos (hoy en adelante)
        $proximos = Evento::where('fecha', '>=', Carbon::today())
                          ->orderBy('fecha', 'asc')
                          ->take(5)
                          ->get();

        // 👇 importante pasar $fin
        return view('admin.calendario.index', compact('mes','anio','inicio','fin','eventos','proximos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'fecha' => 'required|date',
        ]);

        Evento::create($request->only('titulo', 'descripcion', 'fecha'));

        return redirect()->route('admin.calendario.index')->with('success', 'Evento agregado correctamente');
    }
}
