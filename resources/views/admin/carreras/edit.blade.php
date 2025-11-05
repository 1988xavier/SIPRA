<x-admin-layout>
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-extrabold text-gray-800">Editar Carrera</h1>
        <a href="{{ route('admin.carreras.index') }}" class="text-sm text-blue-600 hover:underline">← Volver</a>
    </div>

    <form action="{{ route('admin.carreras.update', $carrera) }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-6 rounded-lg shadow">
        @csrf
        @method('PUT')

        {{-- Fila 1: Nombre --}}
        <div>
            <label class="block text-sm font-medium">Nombre de la Carrera</label>
            <input type="text" name="nombre" value="{{ old('nombre', $carrera->nombre) }}" class="w-full border rounded p-2" required>
        </div>

        {{-- Fila 2: Descripción y Perfil de Ingreso --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium">Descripción</label>
                <textarea name="descripcion" class="w-full border rounded p-2" rows="2">{{ old('descripcion', $carrera->descripcion) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium">Perfil de Ingreso</label>
                <textarea name="objetivo" class="w-full border rounded p-2" rows="2">{{ old('objetivo', $carrera->objetivo) }}</textarea>
            </div>
        </div>

        {{-- Fila 3: Perfil de Egreso y Plan de Estudio --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium">Perfil de Egreso</label>
                <textarea name="perfil" class="w-full border rounded p-2" rows="2">{{ old('perfil', $carrera->perfil) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium">Plan de Estudio</label>
                <textarea name="plan_estudio" class="w-full border rounded p-2" rows="2">{{ old('plan_estudio', $carrera->plan_estudio) }}</textarea>
            </div>
        </div>

        {{-- Fila 4: Desarrollo Profesional y Requisitos --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium">Desarrollo Profesional</label>
                <textarea name="desarrollo_profesional" class="w-full border rounded p-2" rows="2">{{ old('desarrollo_profesional', $carrera->desarrollo_profesional) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium">Requisitos</label>
                <textarea name="requisitos" class="w-full border rounded p-2" rows="2">{{ old('requisitos', $carrera->requisitos) }}</textarea>
            </div>
        </div>

        

        {{-- Imágenes actuales --}}
        <div>
            <label class="block text-sm font-medium">Imágenes actuales</label>
            <div class="flex gap-2 flex-wrap mb-2 overflow-x-auto">
                @foreach($carrera->imagenes()->get() as $img)
                    <div class="relative media-item">
                        <img src="{{ asset('storage/'.$img->ruta) }}" alt="Imagen carrera" class="h-24 rounded flex-shrink-0">
                        <button type="button"
                                onclick="deleteMedia({{ $img->id }}, this)"
                                class="absolute top-1 right-1 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm hover:bg-red-700">
                            &times;
                        </button>
                    </div>
                @endforeach
            </div>
            <input type="file" name="imagenes[]" multiple class="w-full border rounded p-2">
        </div>

        {{-- Videos actuales --}}
        <div>
            {{-- Nuevo campo: URL YouTube --}}
<div class="mt-2">
    <label class="block text-sm font-medium">Enlace de Video (YouTube)</label>
    <input type="url" name="video_url" value="{{ old('video_url', $carrera->multimedia()->where('tipo','video_url')->value('ruta')) }}" 
        class="w-full border rounded p-2" placeholder="https://youtu.be/xyz123">

    <p class="text-xs text-gray-500 mt-1">
        Si agregas un enlace de YouTube, se mostrará en la página de la carrera.
    </p>
</div>

{{-- MP4 opcional --}}
<input type="file" name="videos[]" class="w-full border rounded p-2 mt-2" accept="video/mp4">
<p class="text-xs text-gray-500">MP4 máximo 10MB</p>

            <div class="flex gap-2 flex-wrap mb-2 overflow-x-auto">
                @foreach($carrera->videos()->get() as $video)
                    <div class="relative media-item">
                        <video controls src="{{ asset('storage/'.$video->ruta) }}" class="h-24 rounded flex-shrink-0"></video>
                        <button type="button"
                                onclick="deleteMedia({{ $video->id }}, this)"
                                class="absolute top-1 right-1 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm hover:bg-red-700">
                            &times;
                        </button>
                    </div>
                @endforeach
            </div>
            <input type="file" name="videos[]" multiple class="w-full border rounded p-2">
        </div>

        {{-- Botones de formulario --}}
        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.carreras.index') }}" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Cancelar</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Actualizar</button>
        </div>
    </form>

    <script>
        function deleteMedia(id, button) {
            if(!confirm('¿Deseas eliminar este archivo?')) return;

            fetch(`/admin/carreras/multimedia/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    button.closest('.media-item').remove();
                } else {
                    alert('No se pudo eliminar. Intenta de nuevo.');
                }
            })
            .catch(() => alert('Error de conexión.'));
        }
    </script>

</x-admin-layout>
