<x-admin-layout>

    <h1 class="text-2xl font-bold text-gray-800 mb-6">
        Detalles del Ciclo {{ $ciclo->anio }}
    </h1>

    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <p><strong>Fecha de inicio:</strong> {{ $ciclo->fecha_inicio }}</p>
        <p><strong>Fecha de cierre:</strong> {{ $ciclo->fecha_cierre ?? '---' }}</p>
        <p><strong>Estado:</strong> {{ ucfirst($ciclo->estado) }}</p>
    </div>

    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-bold mb-4">Aspirantes registrados en este ciclo</h2>

        @if($aspirantes->isEmpty())
            <p class="text-gray-600">No hay aspirantes registrados en este ciclo.</p>
        @else
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-3 border-b">Nombre</th>
                        <th class="p-3 border-b">Carrera</th>
                        <th class="p-3 border-b">Status</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($aspirantes as $a)
                        <tr class="hover:bg-gray-50">
                            <td class="p-3 border-b">{{ $a->nombre }} {{ $a->apellido_paterno }} {{ $a->apellido_materno }}</td>
                            <td class="p-3 border-b">
                                {{ $a->carreraPrincipal->nombre ?? '---' }}
                            </td>
                            <td class="p-3 border-b">{{ $a->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

</x-admin-layout>
