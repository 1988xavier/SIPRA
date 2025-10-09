<x-admin-layout>
    <h1 class="text-3xl font-extrabold text-gray-800 mb-6">Generar Reporte de Aspirantes</h1>

    <form method="POST" action="{{ route('admin.reportes.exportar') }}">
        @csrf

        <p class="mb-4 text-gray-600">Selecciona los campos que deseas incluir en el reporte Excel:</p>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="campos[]" value="nombre" class="rounded text-blue-600">
                <span>Nombre</span>
            </label>

            <label class="flex items-center space-x-2">
                <input type="checkbox" name="campos[]" value="apellido_paterno" class="rounded text-blue-600">
                <span>Apellido Paterno</span>
            </label>

            <label class="flex items-center space-x-2">
                <input type="checkbox" name="campos[]" value="apellido_materno" class="rounded text-blue-600">
                <span>Apellido Materno</span>
            </label>

            <label class="flex items-center space-x-2">
                <input type="checkbox" name="campos[]" value="email" class="rounded text-blue-600">
                <span>Email</span>
            </label>

            <label class="flex items-center space-x-2">
                <input type="checkbox" name="campos[]" value="telefono" class="rounded text-blue-600">
                <span>Teléfono</span>
            </label>

            <label class="flex items-center space-x-2">
                <input type="checkbox" name="campos[]" value="escuela_procedencia" class="rounded text-blue-600">
                <span>Escuela de procedencia</span>
            </label>

            <label class="flex items-center space-x-2">
                <input type="checkbox" name="campos[]" value="fecha_nacimiento" class="rounded text-blue-600">
                <span>Fecha de nacimiento</span>
            </label>

            <label class="flex items-center space-x-2">
                <input type="checkbox" name="campos[]" value="carrera_principal_id" class="rounded text-blue-600">
                <span>Carrera principal</span>
            </label>
        </div>

        <button type="submit"
            class="bg-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-700">
            Generar Excel
        </button>
    </form>
</x-admin-layout>
