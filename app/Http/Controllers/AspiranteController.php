<?php

namespace App\Http\Controllers;

use App\Models\Aspirante;
use App\Models\Carrera;
use Illuminate\Http\Request;

class AspiranteController extends Controller
{
    public function create()
    {
        $carreras = Carrera::orderBy('nombre')->get();
        return view('aspirantes.pre-registro', compact('carreras'));
    }

    public function store(Request $request)
    {
        // Validación
        $request->validate([
            'nombre'               => 'required|string|max:100',
            'apellido_paterno'     => 'required|string|max:100',
            'apellido_materno'     => 'nullable|string|max:100',
            'telefono'             => 'required|string|max:20',
            'email'                => 'required|email',
            'carrera_principal_id' => 'required|exists:carreras,id',
            'destacamientos'       => 'nullable|string',
        ]);

        // Verificar si el correo ya se ha usado 3 veces
        $count = Aspirante::where('email', $request->email)->count();

        if ($count >= 3) {
            return back()->with('error', 'Ya has registrado el máximo de 3 carreras permitidas.')->withInput();
        }

        // Crear aspirante sin contraseña
        $aspirante = Aspirante::create([
            'nombre'               => $request->nombre,
            'apellido_paterno'     => $request->apellido_paterno,
            'apellido_materno'     => $request->apellido_materno,
            'telefono'             => $request->telefono,
            'email'                => $request->email,
            'carrera_principal_id' => $request->carrera_principal_id,
            'destacamientos'       => $request->destacamientos,
            'status'               => 'proceso',
            'accepted_terms'       => true,
        ]);

        return redirect()->route('admin.aspirantes.create')
                         ->with('success', 'El aspirante se ha registrado correctamente.');
    }



    public function form(\App\Models\Carrera $carrera)
{
    return view('aspirantes.pre_registro', compact('carrera'));
}




public function guardar(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:100',
        'apellido_paterno' => 'required|string|max:100',
        'apellido_materno' => 'nullable|string|max:100',
        'telefono' => 'required|string|max:20',
        'email' => 'required|email',
        'escuela_procedencia' => 'nullable|string',
        'carrera_principal_id' => 'required|exists:carreras,id',
    ]);

    Aspirante::create([
        'nombre' => $request->nombre,
        'apellido_paterno' => $request->apellido_paterno,
        'apellido_materno' => $request->apellido_materno,
        'telefono' => $request->telefono,
        'email' => $request->email,
        'escuela_procedencia' => $request->escuela_procedencia,
        'carrera_principal_id' => $request->carrera_principal_id,
        'status' => 'proceso',
        'accepted_terms' => true,
    ]);

   return redirect()->route('pre.registro.exito');


}

public function exito()
{
    return view('aspirantes.registro_exitoso');
}


}
