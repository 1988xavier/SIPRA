<x-admin-layout>
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-800">Gestión de Carreras</h1>
        </div>
        <a href="{{ route('admin.carreras.create') }}" class="text-blue-600 hover:underline text-sm font-semibold">
            + Crear Carrera
        </a>

    </div>

    {{-- Barra de búsqueda --}}
    <form method="GET" class="mb-4">
        <div class="relative max-w-md">
            <span class="absolute left-3 top-2.5 text-gray-400">🔎</span>
            <input type="text" name="q" value="{{ $search ?? '' }}" placeholder="Buscar Carreras"
                   class="w-full pl-9 pr-3 py-2 rounded-full border border-gray-300 focus:ring-blue-200 focus:border-blue-500">
        </div>
    </form>

    {{-- Tabla de carreras --}}
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <th class="px-4 py-3 text-left">Nombre</th>
                    <th class="px-4 py-3 text-left">Descripción</th>
                    <th class="px-4 py-3 text-center">Multimedia</th>
                    <th class="px-4 py-3 text-center">Estado</th>
                    <th class="px-4 py-3 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($carreras as $c)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-800">{{ $c->nombre }}</td>
                        <td class="px-4 py-3 text-gray-700 max-w-xs truncate">{{ $c->descripcion }}</td>
                        <td class="px-4 py-3 text-center">
                            🎥 🖼️
                        </td>
                        <td class="px-4 py-3 text-center">
                            @if($c->activo)
                                <span class="px-3 py-1 rounded-full text-xs bg-green-100 text-green-700">Activo</span>
                            @else
                                <span class="px-3 py-1 rounded-full text-xs bg-gray-200 text-gray-600">Inactivo</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center space-x-3">
                            <a href="{{ route('admin.carreras.edit', $c) }}" class="text-blue-600 hover:underline">Editar</a>

                            <form action="{{ route('admin.carreras.destroy', $c) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('¿Seguro que deseas eliminar esta carrera?')" class="text-red-600 hover:underline">Eliminar</button>
                            </form>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                            No hay carreras registradas aún.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    <div class="mt-4">
        {{ $carreras->links() }}
    </div>
</x-admin-layout>
