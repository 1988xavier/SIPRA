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
        $request->validate([
            'nombre'            => 'required|string|max:255',
            'apellido_paterno'  => 'required|string|max:255',
            'apellido_materno'  => 'nullable|string|max:255',
            'fecha_nacimiento'  => 'nullable|date',
            'escuela_procedencia' => 'nullable|string|max:255',
            'telefono'          => 'nullable|string|max:20',
            'email'             => 'required|email|unique:aspirantes,email',
            'password'          => 'required|string|min:6',
            'carreras'          => 'required|array|max:3',
            'carreras.*'        => 'exists:carreras,id',
        ]);

        $aspirante = Aspirante::create([
            'nombre'            => $request->nombre,
            'apellido_paterno'  => $request->apellido_paterno,
            'apellido_materno'  => $request->apellido_materno,
            'fecha_nacimiento'  => $request->fecha_nacimiento,
            'escuela_procedencia' => $request->escuela_procedencia,
            'telefono'          => $request->telefono,
            'email'             => $request->email,
            'password'          => $request->password, // se encripta automático por el mutator
            'status'            => 'proceso',
            'accepted_terms'    => true,
        ]);

        $aspirante->carreras()->sync($request->carreras);

        return redirect()->route('aspirantes.create.public')
                         ->with('success', 'Tu pre-registro se ha enviado correctamente. La universidad se pondrá en contacto contigo.');
    }
}
