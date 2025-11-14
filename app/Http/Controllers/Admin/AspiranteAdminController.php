<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aspirante;
use App\Models\Carrera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AvisoAspiranteMail;
use App\Models\HistorialContacto;
use App\Models\CicloPromocion;


class AspiranteAdminController extends Controller
{
    public function index(Request $request)
    
{
    

    $search    = $request->string('q')->toString();
    $estado    = $request->string('estado')->toString();
    $carreraId = $request->integer('carrera');
    $cicloActivo = CicloPromocion::where('estado', 'activo')->first();



    $query = Aspirante::query()->with(['carreraPrincipal' => function($q){ 
        $q->select('id','nombre'); 
    }]);

    // ✅ BÚSQUEDA CORRECTA
    if ($search !== '') {
        $query->where(function ($q) use ($search) {
            $q->where('nombre', 'like', "%{$search}%")
              ->orWhere('apellido_paterno', 'like', "%{$search}%")
              ->orWhere('apellido_materno', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");
        });
    }

    if ($estado !== '') {
        $query->where('status', $estado);
    }

    if ($carreraId) {
        $query->where('carrera_principal_id', $carreraId);
    }

     // 🟧 NUEVO: FILTRO POR CICLO
    if ($cicloActivo) {
        $query->where('ciclo_id', $cicloActivo->id);
    } else {
        $query->whereNull('id'); // Si no hay ciclo → no mostrar nada
    }

    $aspirantes = $query->orderByDesc('created_at')->paginate(10)->withQueryString();
    $carreras   = Carrera::orderBy('nombre')->get(['id','nombre']);

    return view('admin.aspirantes.index', compact('aspirantes','carreras','search','estado','carreraId'));
}

    // Crear aspirante
   public function store(Request $request)
{
    $request->validate([
        'nombre'               => 'required|string|max:100',
        'apellido_paterno'     => 'required|string|max:100',
        'apellido_materno'     => 'nullable|string|max:100',
        'telefono'             => 'required|string|max:20',
        'email'                => 'required|email',
        'carrera_principal_id' => 'required|exists:carreras,id',
        'destacamientos'       => 'nullable|string',
    ]);

    // Obtener ciclo activo
    $cicloActivo = \App\Models\CicloPromocion::where('estado', 'activo')->first();

    // Crear aspirante y ASIGNARLE EL CICLO ACTIVO
    Aspirante::create([
        'nombre'               => $request->nombre,
        'apellido_paterno'     => $request->apellido_paterno,
        'apellido_materno'     => $request->apellido_materno,
        'telefono'             => $request->telefono,
        'email'                => $request->email,
        'carrera_principal_id' => $request->carrera_principal_id,
        'destacamientos'       => $request->destacamientos,
        'status'               => 'proceso',
        'accepted_terms'       => true,
        'ciclo_id' => $request->ciclo_id ?? $cicloActivo->id ?? null,

    ]);

    return redirect()->route('admin.aspirantes.create')
                     ->with('success', 'El aspirante se ha registrado correctamente.');
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
