<x-admin-layout>
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-extrabold text-gray-800">Editar Carrera</h1>
        <a href="{{ route('admin.carreras.index') }}" class="text-sm text-blue-600 hover:underline">← Volver</a>
    </div>

    <form action="{{ route('admin.carreras.update', $carrera) }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-6 rounded-lg shadow">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium">Nombre de la Carrera</label>
            <input type="text" name="nombre" value="{{ old('nombre', $carrera->nombre) }}" class="w-full border rounded p-2" required>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium">Descripción</label>
                <textarea name="descripcion" class="w-full border rounded p-2" rows="2">{{ old('descripcion', $carrera->descripcion) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium">Objetivo</label>
                <textarea name="objetivo" class="w-full border rounded p-2" rows="2">{{ old('objetivo', $carrera->objetivo) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium">Perfil</label>
                <textarea name="perfil" class="w-full border rounded p-2" rows="2">{{ old('perfil', $carrera->perfil) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium">Plan de Estudio</label>
                <textarea name="plan_estudio" class="w-full border rounded p-2" rows="2">{{ old('plan_estudio', $carrera->plan_estudio) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium">Desarrollo Profesional</label>
                <textarea name="desarrollo_profesional" class="w-full border rounded p-2" rows="2">{{ old('desarrollo_profesional', $carrera->desarrollo_profesional) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium">Competencias</label>
                <textarea name="competencias" class="w-full border rounded p-2" rows="2">{{ old('competencias', $carrera->competencias) }}</textarea>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium">Requisitos</label>
            <textarea name="requisitos" class="w-full border rounded p-2">{{ old('requisitos', $carrera->requisitos) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium">Capacidad</label>
            <input type="number" name="capacidad" value="{{ old('capacidad', $carrera->capacidad) }}" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block text-sm font-medium">Imagen actual</label>
            @if($carrera->imagen)
                <img src="{{ asset('storage/'.$carrera->imagen) }}" alt="Imagen carrera" class="h-24 mb-2">
            @endif
            <input type="file" name="imagen" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block text-sm font-medium">Video actual</label>
            @if($carrera->video)
                <video src="{{ asset('storage/'.$carrera->video) }}" controls class="h-24 mb-2"></video>
            @endif
            <input type="file" name="video" class="w-full border rounded p-2">
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.carreras.index') }}" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Cancelar</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Actualizar</button>
        </div>
    </form>
</x-admin-layout>
