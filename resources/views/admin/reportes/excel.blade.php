<x-admin-layout>
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-800">Generar Reporte de Aspirantes</h1>
            <p class="text-gray-500 text-sm">Selecciona los campos y filtros para generar tu reporte personalizado</p>
        </div>
    </div>

    {{-- Filtros --}}
    <form method="GET" class="mb-6 flex flex-wrap items-center gap-4">
        <div>
            <label for="carrera_id" class="text-sm font-semibold text-gray-700">Filtrar por carrera:</label>
            <select name="carrera_id" id="carrera_id"
                class="rounded-md border-gray-300 focus:ring-blue-200 focus:border-blue-500">
                <option value="">Todas las carreras</option>
                @foreach ($carreras as $c)
                    <option value="{{ $c->id }}" {{ $carreraId == $c->id ? 'selected' : '' }}>
                        {{ $c->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit"
            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Aplicar filtro</button>
    </form>

    {{-- Formulario principal para exportar --}}
    <form method="POST" action="{{ route('admin.reportes.exportar') }}">
        @csrf
        <input type="hidden" name="carrera_id" value="{{ $carreraId }}">

        <p class="mb-3 text-gray-600">Selecciona los campos que deseas incluir en el reporte Excel:</p>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-3 mb-6">
            @php
                $camposDisponibles = [
                    'nombre' => 'Nombre',
                    'apellido_paterno' => 'Apellido paterno',
                    'apellido_materno' => 'Apellido materno',
                    'correo' => 'Correo electrónico',
                    'telefono' => 'Teléfono',
                    'carrera_principal_id' => 'Carrera principal',
                    'status' => 'Estado',
                    'created_at' => 'Fecha de registro'
                ];
            @endphp

            @foreach ($camposDisponibles as $campo => $label)
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="campos[]" value="{{ $campo }}" class="rounded text-blue-600">
                    <span>{{ $label }}</span>
                </label>
            @endforeach
        </div>

        <button type="submit"
            class="bg-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-700">
            Generar Excel
        </button>
    </form>

    {{-- Tabla previa de aspirantes filtrados --}}
    <hr class="my-6">

    <h2 class="text-xl font-semibold text-gray-700 mb-3">Vista previa de aspirantes filtrados</h2>

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-4 py-2 text-left">Nombre</th>
                    <th class="px-4 py-2 text-left">Correo</th>
                    <th class="px-4 py-2 text-left">Teléfono</th>
                    <th class="px-4 py-2 text-left">Carrera</th>
                    <th class="px-4 py-2 text-left">Estado</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($aspirantes as $a)
                    <tr class="hover:bg-gray-100">
                        <td class="px-4 py-2 text-gray-800">{{ $a->nombre }} {{ $a->apellido_paterno }} {{ $a->apellido_materno }}</td>
                        <td class="px-4 py-2">{{ $a->correo ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $a->telefono ?? '-' }}</td>
                        <td class="px-4 py-2">{{ optional($a->carreraPrincipal)->nombre ?? '-' }}</td>
                        <td class="px-4 py-2">{{ strtoupper($a->status ?? '-') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-3 text-center text-gray-500">
                            No hay aspirantes para mostrar con este filtro.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>
