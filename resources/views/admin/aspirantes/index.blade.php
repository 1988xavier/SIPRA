<x-admin-layout>
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-800">Gestión de aspirantes</h1>
            <p class="text-sm text-gray-500">Aquí puedes buscar, filtrar y gestionar la información de todos los aspirantes</p>
        </div>
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
            <option value="registrado"  @selected(($estado ?? '') === 'registrado')>Registrado</option>
            <option value="proceso"     @selected(($estado ?? '') === 'proceso')>En revisión</option>
            <option value="aceptado"    @selected(($estado ?? '') === 'aceptado')>Aceptado</option>
            <option value="rechazado"   @selected(($estado ?? '') === 'rechazado')>No aceptado</option>
        </select>

        <button class="rounded-full px-4 py-2 bg-blue-600 text-white hover:bg-blue-700">Aplicar</button>
        <a href="{{ route('admin.aspirantes.index') }}" class="rounded-full px-4 py-2 bg-gray-200 hover:bg-gray-300">Limpiar</a>
    </form>

    {{-- Tabla estilo Excel --}}
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <th class="px-4 py-2 text-left">Fecha de registro</th>
                    <th class="px-4 py-2 text-left">Nombre</th>
                    <th class="px-4 py-2 text-left">Apellido materno</th>
                    <th class="px-4 py-2 text-left">Apellido paterno</th>
                    <th class="px-4 py-2 text-left">Teléfono</th>
                    <th class="px-4 py-2 text-left">Correo</th>
                    <th class="px-4 py-2 text-left">Carrera Principal</th>
                    <th class="px-4 py-2 text-left">Estado</th>
                    <th class="px-4 py-2 text-center">Más</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 odd:bg-blue-50 even:bg-white">
                @forelse($aspirantes as $a)
                    <tr class="hover:bg-gray-100">
                        <td class="px-4 py-2 text-gray-700">
                            {{ optional($a->created_at)->format('d-m-Y') ?? '-' }}
                        </td>
                        <td class="px-4 py-2 font-medium text-gray-800">
                            {{ $a->nombre ?? '-' }}
                        </td>
                        <td class="px-4 py-2 text-gray-700">
                            {{ $a->apellido_materno ?? '-' }}
                        </td>
                        <td class="px-4 py-2 text-gray-700">
                            {{ $a->apellido_paterno ?? '-' }}
                        </td>
                        <td class="px-4 py-2 text-gray-700">
                            {{ $a->telefono ?? '-' }}
                        </td>
                        <td class="px-4 py-2 text-gray-700">
                            {{ $a->correo ?? $a->email ?? '-' }}
                        </td>
                        <td class="px-4 py-2 text-gray-700">
                            {{ optional($a->carreraPrincipal)->nombre ?? '-' }}
                        </td>
                        {{-- SOLO mostrar estado con color --}}
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 rounded-full text-xs
                                {{ $a->status==='proceso' ? 'bg-yellow-100 text-yellow-700' :
                                ($a->status==='contactado' ? 'bg-orange-100 text-orange-700' :
                                ($a->status==='registrado' ? 'bg-green-100 text-green-700' :
                                'bg-red-100 text-red-700')) }}">
                                {{ strtoupper(str_replace('_',' ',$a->status)) }}
                            </span>
                        </td>

                        {{-- Columna "Más" con lupa + eliminar --}}
                        <td class="px-4 py-2 text-center flex justify-center items-center space-x-2">
                            <!-- Lupa: abrir modal -->
                            <button type="button"
                                    class="px-2 py-1 rounded hover:bg-gray-100 text-blue-600"
                                    data-open="modal-{{ $a->id }}"
                                    aria-label="Ver información del aspirante">
                                🔍
                            </button>

                            <!-- Eliminar: formulario con método DELETE -->
                            <form method="POST"
                                  action="{{ route('admin.aspirantes.destroy', $a->id) }}"
                                  onsubmit="return confirm('¿Estás seguro que deseas eliminar este aspirante?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-2 py-1 rounded hover:bg-gray-100 text-red-600"
                                        aria-label="Eliminar aspirante">
                                    🗑️
                                </button>
                            </form>

                            <!-- Modal detalle del aspirante -->
                            <div id="modal-{{ $a->id }}" class="fixed inset-0 z-50 hidden">
                                <div class="absolute inset-0 bg-black/50" data-close="modal-{{ $a->id }}"></div>
                                <div class="relative flex min-h-screen items-center justify-center p-4">
                                    <div class="relative bg-white rounded-lg shadow w-full max-w-md p-6">
                                        <h2 class="text-xl font-bold mb-4">Información del aspirante</h2>

                                        <div class="space-y-1 text-sm">
                                            <p><strong>Nombre:</strong> {{ $a->nombre }} {{ $a->apellido_paterno }} {{ $a->apellido_materno }}</p>
                                            <p><strong>Correo:</strong> {{ $a->correo ?? $a->email ?? '-' }}</p>
                                            <p><strong>Teléfono:</strong> {{ $a->telefono ?? '-' }}</p>
                                            <p><strong>Carrera:</strong> {{ optional($a->carreraPrincipal)->nombre ?? '-' }}</p>
                                            <p><strong>Estado actual:</strong> {{ strtoupper(str_replace('_',' ',$a->status)) }}</p>
                                        </div>

                                        {{-- Aquí va el select para cambiar estado --}}
                                        <form method="POST" action="{{ route('admin.aspirantes.updateStatus', $a->id) }}" class="mt-4">
                                            @csrf
                                            @method('PATCH')
                                            <label for="status-{{ $a->id }}" class="block text-sm font-medium text-gray-700 mb-1">Cambiar estado</label>
                                            <select id="status-{{ $a->id }}" name="status"
                                                    class="w-full rounded-md border-gray-300 focus:ring-blue-200 focus:border-blue-500">
                                                <option value="proceso"        @selected($a->status==='proceso')>PROCESO</option>
                                                <option value="contactado"     @selected($a->status==='contactado')>CONTACTADO</option>
                                                <option value="registrado"     @selected($a->status==='registrado')>REGISTRADO</option>
                                                <option value="no_registrado"  @selected($a->status==='no_registrado')>NO REGISTRADO</option>
                                            </select>
                                            <div class="mt-3 flex justify-end">
                                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Guardar</button>
                                            </div>
                                        </form>

                                        <div class="mt-4 flex justify-end">
                                            <button type="button"
                                                    class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300"
                                                    data-close="modal-{{ $a->id }}">
                                                Cerrar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-4 py-4 text-center text-gray-500">
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

    {{-- Script abrir/cerrar modales --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function openModal(id) { document.getElementById(id)?.classList.remove('hidden'); }
            function closeModal(id) { document.getElementById(id)?.classList.add('hidden'); }

            document.querySelectorAll('[data-open]').forEach(btn => {
                btn.addEventListener('click', () => openModal(btn.getAttribute('data-open')));
            });
            document.querySelectorAll('[data-close]').forEach(el => {
                el.addEventListener('click', () => closeModal(el.getAttribute('data-close')));
            });
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    document.querySelectorAll('[id^="modal-"]').forEach(m => m.classList.add('hidden'));
                }
            });
        });
    </script>
</x-admin-layout>
