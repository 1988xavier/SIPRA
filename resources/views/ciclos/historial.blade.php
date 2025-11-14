<x-admin-layout>

    <h1 class="text-2xl font-bold text-gray-800 mb-6">Historial de Ciclos</h1>

    <div class="bg-white shadow rounded-lg p-6">

        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-3 border-b">Año</th>
                    <th class="p-3 border-b">Inicio</th>
                    <th class="p-3 border-b">Cierre</th>
                    <th class="p-3 border-b">Estado</th>
                    <th class="p-3 border-b">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @forelse($ciclos as $ciclo)
                    <tr class="hover:bg-gray-50">
                        <td class="p-3 border-b">{{ $ciclo->anio }}</td>
                        <td class="p-3 border-b">{{ $ciclo->fecha_inicio }}</td>
                        <td class="p-3 border-b">{{ $ciclo->fecha_cierre ?? '---' }}</td>
                        <td class="p-3 border-b">
                            <span class="px-2 py-1 rounded text-white
                                {{ $ciclo->estado === 'activo' ? 'bg-green-600' : 'bg-gray-600' }}">
                                {{ ucfirst($ciclo->estado) }}
                            </span>
                        </td>
                        <td class="p-3 border-b">
                            <a href="{{ route('ciclos.detalle', $ciclo->id) }}"
                               class="text-blue-600 hover:underline">
                                Ver detalles
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-3 text-center text-gray-600">
                            No hay ciclos registrados todavía.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

</x-admin-layout>
