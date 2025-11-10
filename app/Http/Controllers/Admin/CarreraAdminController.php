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
            'video_url' => 'nullable|url',
            'facebook' => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255',
            'videos.*' => 'nullable|file|mimes:mp4|max:10240',
        ]);

        $data = $request->except(['imagenes', 'videos']);
        $data['slug'] = Str::slug($request->nombre);
        $data['facebook'] = $request->facebook;
        $data['tiktok'] = $request->tiktok;

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

        // Guardar enlace YouTube
        if ($request->video_url) {
            $carrera->multimedia()->create([
                'tipo' => 'video_url',
                'ruta' => $request->video_url,
            ]);
        }

        // Guardar videos MP4
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
            'video_url' => 'nullable|url',
            'facebook' => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255',
            'videos.*' => 'nullable|file|mimes:mp4|max:10240',
        ]);

        $data = $request->except(['imagenes', 'videos']);
        $data['slug'] = Str::slug($request->nombre);
        $data['facebook'] = $request->facebook;
        $data['tiktok'] = $request->tiktok;

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

        // Guardar enlace YouTube (reemplazar si existe)
        if ($request->video_url) {
            $carrera->multimedia()->where('tipo', 'video_url')->delete();
            $carrera->multimedia()->create([
                'tipo' => 'video_url',
                'ruta' => $request->video_url,
            ]);
        }

        // Agregar nuevos videos MP4
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
        foreach ($carrera->multimedia as $media) {
            Storage::disk('public')->delete($media->ruta);
        }

        $carrera->delete();
        return redirect()->route('admin.carreras.index')->with('success', 'Carrera eliminada correctamente');
    }

    public function destroyMultimedia(CarreraMultimedia $media)
    {
        Storage::disk('public')->delete($media->ruta);
        $media->delete();

        return response()->json(['success' => true]);
    }
}
