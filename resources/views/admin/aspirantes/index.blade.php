<x-admin-layout>
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-800">Gestión de aspirantes</h1>
            <p class="text-sm text-gray-500">Aquí puedes buscar, filtrar y gestionar la información de todos los aspirantes</p>
        </div>
        {{-- Botón en la parte derecha --}}
        <a href="{{ route('admin.aspirantes.create') }}"
           class="px-4 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700">
            + Agregar Nuevo
        </a>
        
    </div>





    {{-- Filtros / Búsqueda --}}
    <form method="GET" class="flex flex-wrap gap-3 items-center mb-4">
        <div class="relative flex-1 min-w-[240px]">
            <span class="absolute left-3 top-2.5 text-gray-400">🔎</span>
            <input type="text" name="q" value="{{ $search ?? '' }}" placeholder="Buscar por nombre o correo"
                class="w-full pl-9 pr-3 py-2 rounded-full border border-gray-300 focus:ring-blue-200 focus:border-blue-500">
        </div>

        <select name="carrera" class="rounded-full border-gray-300 focus:ring-blue-200 focus:border-blue-500">
            <option value="">Carrera</option>
            @foreach($carreras as $c)
                <option value="{{ $c->id }}" @selected(($carreraId ?? null) == $c->id)>{{ $c->nombre }}</option>
            @endforeach
        </select>

        <select name="estado" class="rounded-full border-gray-300 focus:ring-blue-200 focus:border-blue-500">
            <option value="">Estado</option>
            <option value="proceso"   @selected(($estado ?? '') === 'proceso')>En revisión</option>
            <option value="aceptado"  @selected(($estado ?? '') === 'aceptado')>Aceptado</option>
            <option value="rechazado" @selected(($estado ?? '') === 'rechazado')>Rechazado</option>
        </select>

        <button class="rounded-full px-4 py-2 bg-blue-600 text-white hover:bg-blue-700">Aplicar</button>
        <a href="{{ route('admin.aspirantes.index') }}" class="rounded-full px-4 py-2 bg-gray-200 hover:bg-gray-300">Limpiar</a>
    </form>

    {{-- Tabla estilo Excel --}}
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <th class="px-4 py-3 text-left">Nombre</th>
                    <th class="px-4 py-3 text-left">Correo</th>
                    <th class="px-4 py-3 text-left">Teléfono</th> {{-- 👈 NUEVA COLUMNA --}}
                    <th class="px-4 py-3 text-left">Carrera Principal</th>
                    <th class="px-4 py-3 text-left">Estado</th>
                    <th class="px-4 py-3 text-left">Fecha de registro</th>
                    <th class="px-4 py-3 text-center">Más</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($aspirantes as $a)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-800">
                            {{ $a->nombre ?? '-' }} {{ $a->apellidos ?? '' }}
                        </td>
                        <td class="px-4 py-3 text-gray-700">
                            {{ $a->correo ?? $a->email ?? '-' }}
                        </td>
                         <td class="px-4 py-3 text-gray-700"> {{-- 👈 NUEVO CAMPO --}}
                            {{ $a->telefono ?? '-' }}
                        </td>
                        <td class="px-4 py-3 text-gray-700">
                            {{ optional($a->carreraPrincipal)->nombre ?? '-' }}
                        </td>
                        <td class="px-4 py-3">
                            @php $st = $a->status ?? 'proceso'; @endphp
                            <span class="px-2 py-1 rounded-full text-xs
                                {{ $st==='aceptado' ? 'bg-green-100 text-green-700' : ($st==='rechazado' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                                {{ $st==='proceso' ? 'En revisión' : ucfirst($st) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-gray-700">
                            {{ optional($a->created_at)->format('d-m-Y') ?? '-' }}
                        </td>
                        <td class="px-4 py-3 text-center">
                            <button class="px-2 py-1 rounded hover:bg-gray-100">⋮</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                            No hay aspirantes registrados aún.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    <div class="mt-4">
        {{ $aspirantes->links() }}
    </div>
</x-admin-layout>
