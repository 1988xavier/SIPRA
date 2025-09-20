<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carrera;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CarreraAdminController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->string('q')->toString();

        $query = Carrera::query();

        if ($search !== '') {
            $query->where('nombre', 'like', "%{$search}%")
                  ->orWhere('descripcion', 'like', "%{$search}%");
        }

        $carreras = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        return view('admin.carreras.index', compact('carreras', 'search'));
    }

    public function create()
    {
        return view('admin.carreras.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'objetivo' => 'nullable|string',
            'perfil' => 'nullable|string',
            'plan_estudio' => 'nullable|string',
            'desarrollo_profesional' => 'nullable|string',
            'competencias' => 'nullable|string',
            'requisitos' => 'nullable|string',
            'imagen' => 'nullable|file|mimes:jpg,jpeg,png|max:61440',
            'video'  => 'nullable|file|mimes:mp4,avi,mov|max:102400',
        ]);

        $data = $request->except(['imagen', 'video']);

        // Crear slug automáticamente
        $data['slug'] = Str::slug($request->nombre);

        // Guardar imagen en JSON
        if ($request->hasFile('imagen')) {
            $data['imagenes'] = json_encode([
                $request->file('imagen')->store('carreras/imagenes', 'public')
            ]);
        }

        // Guardar video en video_url
        if ($request->hasFile('video')) {
            $data['video_url'] = $request->file('video')->store('carreras/videos', 'public');
        }

        Carrera::create($data);

        return redirect()->route('admin.carreras.index')->with('success', 'Carrera creada correctamente');
    }

    public function edit(Carrera $carrera)
    {
        return view('admin.carreras.edit', compact('carrera'));
    }

    public function update(Request $request, Carrera $carrera)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'objetivo' => 'nullable|string',
            'perfil' => 'nullable|string',
            'plan_estudio' => 'nullable|string',
            'desarrollo_profesional' => 'nullable|string',
            'competencias' => 'nullable|string',
            'requisitos' => 'nullable|string',
            'imagen' => 'nullable|file|mimes:jpg,jpeg,png|max:61440',
            'video'  => 'nullable|file|mimes:mp4,avi,mov|max:102400',
        ]);

        $data = $request->except(['imagen', 'video']);

        // Actualizar slug si cambia el nombre
        $data['slug'] = Str::slug($request->nombre);

        // Si hay nueva imagen, reemplaza el JSON
        if ($request->hasFile('imagen')) {
            $data['imagenes'] = json_encode([
                $request->file('imagen')->store('carreras/imagenes', 'public')
            ]);
        }

        // Si hay nuevo video, lo reemplaza
        if ($request->hasFile('video')) {
            $data['video_url'] = $request->file('video')->store('carreras/videos', 'public');
        }

        $carrera->update($data);

        return redirect()->route('admin.carreras.index')->with('success', 'Carrera actualizada correctamente');
    }

    public function destroy(Carrera $carrera)
    {
        $carrera->delete();

        return redirect()->route('admin.carreras.index')->with('success', 'Carrera eliminada correctamente');
    }
}
