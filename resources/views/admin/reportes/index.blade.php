<x-admin-layout>
    <h1 class="text-3xl font-extrabold text-gray-800 mb-6">Generar Reporte de Aspirantes</h1>

    {{-- 🔹 Filtro por carrera y estado (usa GET para mostrar resultados filtrados) --}}
    <form method="GET" action="{{ route('admin.reportes.index') }}"
          class="flex flex-wrap items-center gap-4 mb-6 bg-gray-50 p-4 rounded-lg shadow">

        {{-- Filtro por carrera --}}
        <div class="flex flex-col">
            <label for="carrera_id" class="text-gray-700 font-medium mb-1">Filtrar por carrera</label>
            <select id="carrera_id" name="carrera_id"
                    class="rounded-md border-gray-300 focus:ring-blue-200 focus:border-blue-500 w-64">
                <option value="">Todas las carreras</option>
                @foreach(\App\Models\Carrera::orderBy('nombre')->get() as $c)
                    <option value="{{ $c->id }}" @selected(request('carrera_id') == $c->id)>{{ $c->nombre }}</option>
                @endforeach
            </select>
        </div>

        {{-- Filtro por estado --}}
        <div class="flex flex-col">
            <label for="estado" class="text-gray-700 font-medium mb-1">Filtrar por estado</label>
            <select id="estado" name="estado"
                    class="rounded-md border-gray-300 focus:ring-blue-200 focus:border-blue-500 w-64">
                <option value="">Todos los estados</option>
                <option value="proceso" @selected(request('estado') == 'proceso')>En proceso</option>
                <option value="contactado" @selected(request('estado') == 'contactado')>Contactado</option>
                <option value="registrado" @selected(request('estado') == 'registrado')>Registrado</option>
                <option value="no_registrado" @selected(request('estado') == 'no_registrado')>No registrado</option>
                <option value="aceptado" @selected(request('estado') == 'aceptado')>Aceptado</option>
                <option value="rechazado" @selected(request('estado') == 'rechazado')>Rechazado</option>
            </select>
        </div>

        {{-- Botones de acción --}}
        <div>
            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                Aplicar filtro
            </button>
            <a href="{{ route('admin.reportes.index') }}"
               class="ml-2 bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">
                Limpiar
            </a>
        </div>
    </form>

    {{-- 🔹 Formulario principal (exportación Excel) --}}
    <form method="POST" action="{{ route('admin.reportes.exportar') }}">
        @csrf

        {{-- Enviar filtros activos al backend --}}
        <input type="hidden" name="carrera_id" value="{{ request('carrera_id') }}">
        <input type="hidden" name="estado" value="{{ request('estado') }}">

        {{-- 🔹 Selección de columnas --}}
        <div class="bg-gray-50 p-4 rounded-lg shadow mb-6">
            <p class="mb-3 text-gray-700 font-medium">Selecciona los campos que deseas incluir en el reporte:</p>
            <div class="flex flex-wrap gap-3">
                @php
                    $camposDisponibles = [
                        'nombre' => 'Nombre',
                        'apellido_paterno' => 'Apellido Paterno',
                        'apellido_materno' => 'Apellido Materno',
                        'telefono' => 'Teléfono',
                        'email' => 'Correo electrónico',
                        'escuela_procedencia' => 'Escuela de procedencia',
                        'fecha_nacimiento' => 'Fecha de nacimiento',
                        'carrera_principal_id' => 'Carrera principal',
                        'status' => 'Estado'
                    ];
                @endphp

                @foreach($camposDisponibles as $campo => $label)
                    <label class="flex items-center space-x-2 bg-white border rounded-md px-3 py-2 hover:bg-blue-50">
                        <input type="checkbox" name="campos[]" value="{{ $campo }}" class="rounded text-blue-600">
                        <span class="text-gray-700 text-sm">{{ $label }}</span>
                    </label>
                @endforeach
            </div>
        </div>

       {{-- 🔹 Tabla de aspirantes --}}
@php
    // Ciclo activo
    $cicloActivo = \App\Models\CicloPromocion::where('estado', 'activo')->first();

    $aspirantesQuery = \App\Models\Aspirante::with('carreraPrincipal')
        ->when($cicloActivo, function ($q) use ($cicloActivo) {
            $q->where('ciclo_id', $cicloActivo->id);
        })
        ->orderBy('created_at','desc');

    if (request('carrera_id')) {
        $aspirantesQuery->where('carrera_principal_id', request('carrera_id'));
    }

    if (request('estado')) {
        $aspirantesQuery->where('status', request('estado'));
    }

    $aspirantes = $aspirantesQuery->get();
@endphp


        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="bg-blue-50 text-gray-700 uppercase text-xs">
                        <th class="px-4 py-2 text-left">#</th>
                        <th class="px-4 py-2 text-left">Nombre</th>
                        <th class="px-4 py-2 text-left">Apellidos</th>
                        <th class="px-4 py-2 text-left">Correo</th>
                        <th class="px-4 py-2 text-left">Teléfono</th>
                        <th class="px-4 py-2 text-left">Carrera</th>
                        <th class="px-4 py-2 text-left">Estado</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($aspirantes as $i => $a)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-gray-500">{{ $i + 1 }}</td>
                            <td class="px-4 py-2 font-medium text-gray-800">{{ $a->nombre }}</td>
                            <td class="px-4 py-2 text-gray-700">{{ $a->apellido_paterno }} {{ $a->apellido_materno }}</td>
                            <td class="px-4 py-2 text-gray-700">{{ $a->email }}</td>
                            <td class="px-4 py-2 text-gray-700">{{ $a->telefono }}</td>
                            <td class="px-4 py-2 text-gray-700">{{ optional($a->carreraPrincipal)->nombre ?? '-' }}</td>
                            <td class="px-4 py-2 text-gray-700">{{ strtoupper($a->status) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-4 text-center text-gray-500">
                                No hay aspirantes registrados con este filtro.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- 🔹 Botón de exportar --}}
        <div class="mt-6 flex justify-end">
            <button type="submit"
                class="bg-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-700">
                📊 Generar Excel
            </button>
        </div>
    </form>
</x-admin-layout>
