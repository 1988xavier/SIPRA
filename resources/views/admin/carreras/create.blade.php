<x-admin-layout>
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-extrabold text-gray-800">Crear Nueva Carrera</h1>
        <a href="{{ route('admin.carreras.index') }}" class="text-sm text-blue-600 hover:underline">← Volver a la lista</a>
    </div>

    <form action="{{ route('admin.carreras.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-6 rounded-lg shadow">
        @csrf

        <div>
            <label class="block text-sm font-medium">Nombre de la Carrera</label>
            <input type="text" name="nombre" class="w-full border rounded p-2"
                placeholder="Ej. Ingeniería en Animación y Efectos Visuales" required>
        </div>

        {{-- ✅ TODOS LOS CAMPOS EN UNA COLUMNA Y MÁS GRANDES --}}
        <div class="space-y-4">

            <div>
                <label class="block text-sm font-medium">Descripción</label>
                <textarea name="descripcion" class="w-full border rounded p-2"
                    rows="5"
                    placeholder="Escribe una descripción general de la carrera, su propósito y qué la hace única..."></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium">Objetivo</label>
                <textarea name="objetivo" class="w-full border rounded p-2"
                    rows="5"
                    placeholder="Describe los objetivos formativos principales de esta carrera..."></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium">Perfil</label>
                <textarea name="perfil" class="w-full border rounded p-2"
                    rows="5"
                    placeholder="Explica el perfil de egreso: conocimientos, habilidades y valores del estudiante..."></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium">Plan de Estudio</label>
                <textarea name="plan_estudio" class="w-full border rounded p-2"
                    rows="5"
                    placeholder="Incluye aquí el plan de estudios: semestres, asignaturas o módulos principales..."></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium">Desarrollo Profesional</label>
                <textarea name="desarrollo_profesional" class="w-full border rounded p-2"
                    rows="5"
                    placeholder="Áreas laborales donde puede trabajar el egresado, roles y oportunidades profesionales..."></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium">Competencias</label>
                <textarea name="competencias" class="w-full border rounded p-2"
                    rows="5"
                    placeholder="Describe las competencias generales y específicas que desarrollará el estudiante..."></textarea>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium">Requisitos</label>
            <textarea name="requisitos" class="w-full border rounded p-2"
                rows="5"
                placeholder="Indica los requisitos necesarios para ingresar: documentos, estudios previos, etc."></textarea>
        </div>

        <!-- ✅ Redes sociales -->
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium">Facebook de la Carrera</label>
                <input type="text"
                       name="facebook"
                       class="w-full border rounded p-2"
                       placeholder="https://facebook.com/tu_carrera">
            </div>

            <div>
                <label class="block text-sm font-medium">TikTok de la Carrera</label>
                <input type="text"
                       name="tiktok"
                       class="w-full border rounded p-2"
                       placeholder="https://tiktok.com/@tu_carrera">
            </div>
        </div>

        <!-- ✅ SOLO dejar imágenes múltiples -->
        <div>
            <label class="block text-sm font-medium">Imágenes de la Carrera</label>
            <input type="file" name="imagenes[]" multiple class="w-full border rounded p-2">
        </div>

        <!-- ✅ SOLO dejar enlace de YouTube -->
        <div>
            <label class="block text-sm font-medium">Enlace de Video (YouTube)</label>
            <input type="url" name="video_url" class="w-full border rounded p-2" placeholder="https://youtu.be/xyz123">

            <p class="text-xs text-gray-500 mt-1">
                Puedes pegar un enlace de YouTube. Ejemplo: https://youtu.be/ABC123  
            </p>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.carreras.index') }}" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Cancelar</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Guardar</button>
        </div>
    </form>
</x-admin-layout>
