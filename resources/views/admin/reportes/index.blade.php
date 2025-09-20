<x-admin-layout>
    <h1 class="text-3xl font-extrabold text-gray-800 mb-6">Reportes</h1>

    {{-- Panel de generación --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Reporte general -->
        <div class="bg-gray-100 p-6 rounded-lg shadow">
            <h2 class="text-lg font-bold mb-2">Lista de aspirantes</h2>
            <p class="text-sm text-gray-600 mb-4">Genera la lista completa con todos los aspirantes registrados en el sistema</p>
            <div class="flex gap-3">
                <button class="flex-1 bg-red-600 text-white py-2 rounded-md hover:bg-red-700">PDF</button>
                <button class="flex-1 bg-green-600 text-white py-2 rounded-md hover:bg-green-700">Excel</button>
            </div>
        </div>

        <!-- Reporte por carrera -->
        <div class="bg-gray-100 p-6 rounded-lg shadow">
            <h2 class="text-lg font-bold mb-2">Aspirantes por carrera</h2>
            <p class="text-sm text-gray-600 mb-4">Crea un reporte de aspirantes filtrado por la carrera de interés</p>
            <select class="w-full mb-4 border border-gray-300 rounded-md">
                <option value="">Seleccionar carrera</option>
                @foreach($carreras as $c)
                    <option value="{{ $c->id }}">{{ $c->nombre }}</option>
                @endforeach
            </select>
            <div class="flex gap-3">
                <button class="flex-1 bg-red-600 text-white py-2 rounded-md hover:bg-red-700">PDF</button>
                <button class="flex-1 bg-green-600 text-white py-2 rounded-md hover:bg-green-700">Excel</button>
            </div>
        </div>

        <!-- Reporte detallado -->
        <div class="bg-gray-100 p-6 rounded-lg shadow">
            <h2 class="text-lg font-bold mb-2">Información completa por carrera</h2>
            <p class="text-sm text-gray-600 mb-4">Genera un reporte detallado con toda la información de los aspirantes de una carrera específica</p>
            <select class="w-full mb-4 border border-gray-300 rounded-md">
                <option value="">Seleccionar carrera</option>
                @foreach($carreras as $c)
                    <option value="{{ $c->id }}">{{ $c->nombre }}</option>
                @endforeach
            </select>
            <div class="flex gap-3">
                <button class="flex-1 bg-red-600 text-white py-2 rounded-md hover:bg-red-700">PDF</button>
                <button class="flex-1 bg-green-600 text-white py-2 rounded-md hover:bg-green-700">Excel</button>
            </div>
        </div>
    </div>

    {{-- Historial --}}
    <h2 class="text-xl font-bold mb-4">Historial de Reportes Generados</h2>
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <th class="px-4 py-3 text-left">Tipo de Reporte</th>
                    <th class="px-4 py-3 text-left">Fecha de Creación</th>
                    <th class="px-4 py-3 text-left">Formato</th>
                    <th class="px-4 py-3 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($historial as $h)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-800">{{ $h['tipo'] }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $h['fecha'] }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $h['formato'] }}</td>
                        <td class="px-4 py-3 text-center space-x-3">
                            <button class="text-blue-600 hover:underline">⬇ Descargar</button>
                            <button class="text-gray-600 hover:underline">🗑 Eliminar</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-8 text-center text-gray-500">
                            Aún no se han generado reportes.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>
