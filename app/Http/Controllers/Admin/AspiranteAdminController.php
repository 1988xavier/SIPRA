<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aspirante;
use App\Models\Carrera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AvisoAspiranteMail;
use App\Models\HistorialContacto;

class AspiranteAdminController extends Controller
{
    public function index(Request $request)
    {
        $search    = $request->string('q')->toString();
        $estado    = $request->string('estado')->toString();
        $carreraId = $request->integer('carrera');

        $query = Aspirante::query()->with(['carreraPrincipal' => function($q){ 
            $q->select('id','nombre'); 
        }]);

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                  ->orWhere('apellidos', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($estado !== '') {
            $query->where('status', $estado);
        }

        if ($carreraId) {
            $query->where('carrera_principal_id', $carreraId);
        }

        $aspirantes = $query->orderByDesc('created_at')->paginate(10)->withQueryString();
        $carreras   = Carrera::orderBy('nombre')->get(['id','nombre']);

        return view('admin.aspirantes.index', compact('aspirantes','carreras','search','estado','carreraId'));
    }

    // Crear aspirante
    public function store(Request $request)
{
    $validated = $request->validate([
        'nombre'              => 'required|string|max:100',
        'apellido_paterno'    => 'required|string|max:100',
        'apellido_materno'    => 'required|string|max:100',
        'telefono'            => 'required|string|max:20',
        'email'               => 'required|email|unique:aspirantes,email',
        'carrera_principal_id'=> 'required|exists:carreras,id',
        'fecha_nacimiento'    => 'nullable|date',
        'escuela_procedencia' => 'nullable|string|max:255',
    ]);

    Aspirante::create([
        'nombre'              => $validated['nombre'],
        'apellido_paterno'    => $validated['apellido_paterno'],
        'apellido_materno'    => $validated['apellido_materno'],
        'telefono'            => $validated['telefono'],
        'email'               => $validated['email'],
        'carrera_principal_id'=> $validated['carrera_principal_id'],
        'fecha_nacimiento'    => $validated['fecha_nacimiento'] ?? null,
        'escuela_procedencia' => $validated['escuela_procedencia'] ?? null,
        'status'              => 'proceso', // valor inicial
    ]);

    return redirect()->route('admin.aspirantes.index')->with('success', 'Aspirante agregado correctamente.');
}


    // NUEVO MÉTODO: Actualizar el estado desde el modal
public function updateStatus(Request $request, Aspirante $aspirante)
{
    $request->validate([
        'status' => 'required|in:proceso,contactado,registrado,no_registrado',
    ]);

    $aspirante->update([
        'status' => $request->status
    ]);

    return back()->with('success', 'Estado actualizado correctamente.');
}


// Crear aspirante
public function create()
{
    $carreras = Carrera::orderBy('nombre')->get(['id','nombre']);
    return view('admin.aspirantes.create', compact('carreras'));
}


    public function destroy(Aspirante $aspirante)
{
    $aspirante->delete();
    return redirect()->route('admin.aspirantes.index')
                     ->with('success', 'Aspirante eliminado correctamente.');
}





public function enviarCorreo(Request $request, Aspirante $aspirante)
{
    $request->validate([
        'mensaje' => 'required|string|max:1000',
    ]);

    Mail::to($aspirante->email)->send(new AvisoAspiranteMail(
        $aspirante->nombre,
        $request->mensaje
    ));


    HistorialContacto::create([
    'aspirante_id' => $aspirante->id,
    'tipo' => 'correo',
    'mensaje' => $request->mensaje,
]);

    return back()->with('success', 'Correo enviado correctamente a ' . $aspirante->email);



    
}



}
