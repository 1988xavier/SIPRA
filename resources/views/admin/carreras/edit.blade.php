<x-admin-layout>
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-extrabold text-gray-800">Editar Carrera</h1>
        <a href="{{ route('admin.carreras.index') }}" class="text-sm text-blue-600 hover:underline">← Volver</a>
    </div>

    <form action="{{ route('admin.carreras.update', $carrera) }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-6 rounded-lg shadow">
        @csrf
        @method('PUT')

        {{-- ✅ Nombre --}}
        <div>
            <label class="block text-sm font-medium">Nombre de la Carrera</label>
            <input type="text" name="nombre"
                   value="{{ old('nombre', $carrera->nombre) }}"
                   class="w-full border rounded p-2"
                   required>
        </div>

        {{-- ✅ Textareas UNO DEBAJO DEL OTRO --}}
        <div class="space-y-4">

            <div>
                <label class="block text-sm font-medium">Descripción</label>
                <textarea name="descripcion"
                          class="w-full border rounded p-2"
                          rows="5"
                          placeholder="Describe brevemente la carrera, su propósito y enfoque principal...">{{ old('descripcion', $carrera->descripcion) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium">Perfil de Ingreso</label>
                <textarea name="objetivo"
                          class="w-full border rounded p-2"
                          rows="5"
                          placeholder="Indica las cualidades o conocimientos deseables en los aspirantes...">{{ old('objetivo', $carrera->objetivo) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium">Perfil de Egreso</label>
                <textarea name="perfil"
                          class="w-full border rounded p-2"
                          rows="5"
                          placeholder="Describe qué sabrá hacer el egresado, habilidades y competencias...">{{ old('perfil', $carrera->perfil) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium">Plan de Estudio</label>
                <textarea name="plan_estudio"
                          class="w-full border rounded p-2"
                          rows="5"
                          placeholder="Lista de semestres, asignaturas o módulos que componen la carrera...">{{ old('plan_estudio', $carrera->plan_estudio) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium">Desarrollo Profesional</label>
                <textarea name="desarrollo_profesional"
                          class="w-full border rounded p-2"
                          rows="5"
                          placeholder="Áreas laborales, empleos o sectores donde puede trabajar el egresado...">{{ old('desarrollo_profesional', $carrera->desarrollo_profesional) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium">Requisitos</label>
                <textarea name="requisitos"
                          class="w-full border rounded p-2"
                          rows="5"
                          placeholder="Documentos y requisitos para el ingreso a la carrera...">{{ old('requisitos', $carrera->requisitos) }}</textarea>
            </div>

        </div>

        {{-- ✅ Redes sociales --}}
        <div class="grid grid-cols-2 gap-4 mt-4">
            <div>
                <label class="block text-sm font-medium">Facebook de la Carrera</label>
                <input type="text" name="facebook"
                       value="{{ old('facebook', $carrera->facebook) }}"
                       class="w-full border rounded p-2"
                       placeholder="https://facebook.com/tu_carrera">
            </div>

            <div>
                <label class="block text-sm font-medium">TikTok de la Carrera</label>
                <input type="text" name="tiktok"
                       value="{{ old('tiktok', $carrera->tiktok) }}"
                       class="w-full border rounded p-2"
                       placeholder="https://tiktok.com/@tu_carrera">
            </div>
        </div>

        {{-- ✅ Imágenes actuales --}}
        <div>
            <label class="block text-sm font-medium">Imágenes actuales</label>

            <div class="flex gap-2 flex-wrap mb-2 overflow-x-auto">
                @foreach($carrera->imagenes()->get() as $img)
                    <div class="relative media-item">
                        <img src="{{ asset('storage/'.$img->ruta) }}"
                             alt="Imagen carrera"
                             class="h-24 rounded flex-shrink-0">
                        <button type="button"
                                onclick="deleteMedia({{ $img->id }}, this)"
                                class="absolute top-1 right-1 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm hover:bg-red-700">
                            &times;
                        </button>
                    </div>
                @endforeach
            </div>

            {{-- ✅ ÚNICO INPUT para subir múltiples imágenes --}}
            <input type="file" name="imagenes[]" multiple class="w-full border rounded p-2">
        </div>

        {{-- ✅ Video YouTube --}}
        <div class="mt-4">
            <label class="block text-sm font-medium">Enlace de Video (YouTube)</label>

            <input type="url" name="video_url"
                   value="{{ old('video_url', $carrera->multimedia()->where('tipo','video_url')->value('ruta')) }}"
                   class="w-full border rounded p-2"
                   placeholder="https://youtu.be/xyz123">

            <p class="text-xs text-gray-500 mt-1">
                Este video aparecerá en la página pública de la carrera.
            </p>
        </div>

        {{-- ✅ Botones --}}
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
