<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Evento;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;    

class CalendarioController extends Controller
{
    public function index(Request $request)
    {
        
    // (tus cálculos de fechas y eventos)
    $mes = $request->mes ?? now()->month;
    $anio = $request->anio ?? now()->year;

    $inicio = \Carbon\Carbon::create($anio, $mes, 1);
    $fin = $inicio->copy()->endOfMonth();

    $eventos = \App\Models\Evento::whereBetween('fecha', [$inicio, $fin])->get();
    $proximos = \App\Models\Evento::where('fecha', '>=', now())
                    ->orderBy('fecha', 'asc')
                    ->limit(5)
                    ->get();

    // 🔹 NUEVO: obtener los coordinadores registrados
    $coordinadores = User::where('role', 'coordinador')->orderBy('name')->get();

    return view('admin.calendario.index', compact('eventos', 'proximos', 'inicio', 'fin', 'mes', 'anio', 'coordinadores'));

        // 👇 importante pasar $fin
        return view('admin.calendario.index', compact('mes','anio','inicio','fin','eventos','proximos'));
    }

    public function store(Request $request)
{
    $request->validate([
        'titulo' => 'required|string|max:255',
        'fecha' => 'required|date',
        'hora' => 'nullable|date_format:H:i',
        'lugar' => 'nullable|string|max:255',
        'coordinador1' => 'nullable|string|max:255',
        'coordinador2' => 'nullable|string|max:255',
        'coordinador3' => 'nullable|string|max:255',
    ]);

    \App\Models\Evento::create($request->only([
        'titulo', 'descripcion', 'fecha', 'hora', 'lugar',
        'coordinador1', 'coordinador2', 'coordinador3'
    ]));

    return redirect()->route('admin.calendario.index')
        ->with('success', 'Evento agregado correctamente');
}

}
