<x-admin-layout>
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-extrabold text-gray-800">Crear Nueva Carrera</h1>
        <a href="{{ route('admin.carreras.index') }}" class="text-sm text-blue-600 hover:underline">← Volver a la lista</a>
    </div>

    <form action="{{ route('admin.carreras.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-6 rounded-lg shadow">
        @csrf

        <div>
            <label class="block text-sm font-medium">Nombre de la Carrera</label>
            <input type="text" name="nombre" class="w-full border rounded p-2" placeholder="Ej. Ingeniería en Animación y Efectos Visuales" required>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium">Descripción</label>
                <textarea name="descripcion" class="w-full border rounded p-2" rows="2"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium">Objetivo</label>
                <textarea name="objetivo" class="w-full border rounded p-2" rows="2"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium">Perfil</label>
                <textarea name="perfil" class="w-full border rounded p-2" rows="2"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium">Plan de Estudio</label>
                <textarea name="plan_estudio" class="w-full border rounded p-2" rows="2"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium">Desarrollo Profesional</label>
                <textarea name="desarrollo_profesional" class="w-full border rounded p-2" rows="2"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium">Competencias</label>
                <textarea name="competencias" class="w-full border rounded p-2" rows="2"></textarea>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium">Requisitos</label>
            <textarea name="requisitos" class="w-full border rounded p-2"></textarea>
        </div>

       

        <div>
            <label class="block text-sm font-medium">Imágenes de la Carrera</label>
            <input type="file" name="imagen" class="w-full border rounded p-2">
        </div>

        <div>
    <label class="block text-sm font-medium">Enlace de Video (YouTube)</label>
    <input type="url" name="video_url" class="w-full border rounded p-2" placeholder="https://youtu.be/xyz123">

    <p class="text-xs text-gray-500 mt-1">
        Puedes pegar un enlace de YouTube. Ejemplo: https://youtu.be/ABC123  
        (Recomendado para videos largos)
    </p>
</div>

<div>
    <label class="block text-sm font-medium">Subir video (opcional)</label>
    <input type="file" name="videos[]" class="w-full border rounded p-2" accept="video/mp4">

    <p class="text-xs text-gray-500 mt-1">
        Solo MP4 y menor a 10MB. Si es más grande, usa YouTube.
    </p>
</div>


        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.carreras.index') }}" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Cancelar</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Guardar</button>
        </div>
    </form>
</x-admin-layout>
