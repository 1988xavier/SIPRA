<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carrera;
use App\Models\CarreraMultimedia;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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

        $carreras = $query->with(['multimedia'])->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
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
            'imagenes.*' => 'nullable|file|mimes:jpg,jpeg,png|max:61440',
            'videos.*'  => 'nullable|file|mimes:mp4,avi,mov|max:102400',
        ]);

        $data = $request->except(['imagenes', 'videos']);
        $data['slug'] = Str::slug($request->nombre);
        $carrera = Carrera::create($data);

        // Guardar imágenes
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $file) {
                $ruta = $file->store('carreras/imagenes', 'public');
                $carrera->multimedia()->create([
                    'tipo' => 'imagen',
                    'ruta' => $ruta,
                ]);
            }
        }

        // Guardar videos
        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $file) {
                $ruta = $file->store('carreras/videos', 'public');
                $carrera->multimedia()->create([
                    'tipo' => 'video',
                    'ruta' => $ruta,
                ]);
            }
        }

        return redirect()->route('admin.carreras.index')->with('success', 'Carrera creada correctamente');
    }

    public function edit(Carrera $carrera)
    {
        $carrera->load('multimedia');
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
            'imagenes.*' => 'nullable|file|mimes:jpg,jpeg,png|max:61440',
            'videos.*'  => 'nullable|file|mimes:mp4,avi,mov|max:102400',
        ]);

        $data = $request->except(['imagenes', 'videos']);
        $data['slug'] = Str::slug($request->nombre);
        $carrera->update($data);

        // Agregar nuevas imágenes
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $file) {
                $ruta = $file->store('carreras/imagenes', 'public');
                $carrera->multimedia()->create([
                    'tipo' => 'imagen',
                    'ruta' => $ruta,
                ]);
            }
        }

        // Agregar nuevos videos
        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $file) {
                $ruta = $file->store('carreras/videos', 'public');
                $carrera->multimedia()->create([
                    'tipo' => 'video',
                    'ruta' => $ruta,
                ]);
            }
        }

        return redirect()->route('admin.carreras.index')->with('success', 'Carrera actualizada correctamente');
    }

    public function destroy(Carrera $carrera)
    {
        // Opcional: eliminar archivos físicos
        foreach ($carrera->multimedia as $media) {
            Storage::disk('public')->delete($media->ruta);
        }

        $carrera->delete();
        return redirect()->route('admin.carreras.index')->with('success', 'Carrera eliminada correctamente');
    }



    // Eliminar una imagen o video individual
    public function destroyMultimedia(CarreraMultimedia $media)
    {
        // Eliminar el archivo físico
        Storage::disk('public')->delete($media->ruta);

        // Eliminar registro de la base de datos
        $media->delete();

        // Respuesta JSON para AJAX
        return response()->json(['success' => true]);
    }

}
