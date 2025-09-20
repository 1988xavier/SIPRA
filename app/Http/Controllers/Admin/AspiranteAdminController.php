<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aspirante;
use App\Models\Carrera;
use Illuminate\Http\Request;

class AspiranteAdminController extends Controller
{
    public function index(Request $request)
    {
        $search    = $request->string('q')->toString();
        $estado    = $request->string('estado')->toString();
        $carreraId = $request->integer('carrera');

        // Búsqueda y filtros (opcionales, no fallan si no existen columnas)
        $query = Aspirante::query()->with(['carreraPrincipal' => function($q){ $q->select('id','nombre'); }]);

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                // Ajusta los nombres de columna según tu migración real
                $q->where('nombre', 'like', "%{$search}%")
                  ->orWhere('apellidos', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%"); // si usaste 'email', cambia aquí
            });
        }

        // Si ya tienes una columna 'status' (proceso, aceptado, rechazado), esto filtra; si no, se ignora
        if ($estado !== '') {
            $query->where('status', $estado);
        }

        // Si guardas la carrera principal en 'carrera_principal_id', este filtro funciona
        if ($carreraId) {
            $query->where('carrera_principal_id', $carreraId);
        }

        $aspirantes = $query->orderByDesc('created_at')->paginate(10)->withQueryString();
        $carreras   = Carrera::orderBy('nombre')->get(['id','nombre']);

        return view('admin.aspirantes.index', compact('aspirantes','carreras','search','estado','carreraId'));
    }


//metodo de agrar y destruir alumnos
public function create()
{
    $carreras = Carrera::orderBy('nombre')->get(['id','nombre']);
    return view('admin.aspirantes.create', compact('carreras'));
}

public function store(Request $request)
{
    $validated = $request->validate([
        'nombre'   => 'required|string|max:100',
        'apellido_paterno'  => 'required|string|max:100',
        'apellido_materno'  => 'required|string|max:100',
        'telefono'           => 'required|string|max:20',
        'email'   => 'required|email|unique:aspirantes,email',
        'password' => 'required|min:6|confirmed',
        'carrera_principal_id' => 'required|exists:carreras,id',
    ]);

    $aspirante = Aspirante::create([
        'nombre'   => $validated['nombre'],
        'apellido_paterno'  => $validated['apellido_paterno'],
        'apellido_materno'  => $validated['apellido_materno'],
        'telefono'           => $validated['telefono'],
        'email'   => $validated['email'],
        'password' => bcrypt($validated['password']),
        'carrera_principal_id' => $validated['carrera_principal_id'],
        'status'   => 'proceso', // valor inicial
    ]);

    return redirect()->route('admin.aspirantes.index')->with('success', 'Aspirante agregado correctamente.');
}


}
