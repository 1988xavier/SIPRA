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
                        <td class="px-4 py-2 text-gray-700">{{ optional($a->created_at)->format('d-m-Y') ?? '-' }}</td>
                        <td class="px-4 py-2 font-medium text-gray-800">{{ $a->nombre ?? '-' }}</td>
                        <td class="px-4 py-2 text-gray-700">{{ $a->apellido_materno ?? '-' }}</td>
                        <td class="px-4 py-2 text-gray-700">{{ $a->apellido_paterno ?? '-' }}</td>
                        <td class="px-4 py-2 text-gray-700">{{ $a->telefono ?? '-' }}</td>
                        <td class="px-4 py-2 text-gray-700">{{ $a->correo ?? $a->email ?? '-' }}</td>
                        <td class="px-4 py-2 text-gray-700">{{ optional($a->carreraPrincipal)->nombre ?? '-' }}</td>

                        {{-- Estado con color --}}
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 rounded-full text-xs
                                {{ $a->status==='proceso' ? 'bg-yellow-100 text-yellow-700' :
                                ($a->status==='contactado' ? 'bg-orange-100 text-orange-700' :
                                ($a->status==='registrado' ? 'bg-green-100 text-green-700' :
                                'bg-red-100 text-red-700')) }}">
                                {{ strtoupper(str_replace('_',' ',$a->status)) }}
                            </span>
                        </td>

                        {{-- Botones --}}
                        <td class="px-4 py-2 text-center flex justify-center items-center space-x-2">
                            <button type="button" class="px-2 py-1 rounded hover:bg-gray-100 text-blue-600"
                                    data-open="modal-{{ $a->id }}" aria-label="Ver información del aspirante">🔍</button>

                            <form method="POST" action="{{ route('admin.aspirantes.destroy', $a->id) }}"
                                  onsubmit="return confirm('¿Estás seguro que deseas eliminar este aspirante?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2 py-1 rounded hover:bg-gray-100 text-red-600"
                                        aria-label="Eliminar aspirante">🗑️</button>
                            </form>
                        </td>
                    </tr>

                    {{-- Modal de detalle del aspirante --}}
                    <div id="modal-{{ $a->id }}" class="fixed inset-0 z-50 hidden">
                        <div class="absolute inset-0 bg-black/50" data-close="modal-{{ $a->id }}"></div>
                        <div class="relative flex min-h-screen items-center justify-center p-4">
                            <div class="relative bg-white rounded-xl shadow-lg w-full max-w-6xl p-10 text-left">
                                <div class="flex justify-between items-center border-b pb-2 mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Información del aspirante</h2>
    <button type="button"
            class="text-gray-500 hover:text-gray-700 text-sm font-semibold flex items-center gap-1"
            data-close="modal-{{ $a->id }}">
        ✖️ Cerrar
    </button>
</div>


                                {{-- Info general --}}
                                <div class="grid grid-cols-2 gap-4 text-sm text-gray-700 mb-4">
                                    <div><p class="font-semibold text-gray-800">Nombre:</p><p>{{ $a->nombre }} {{ $a->apellido_paterno }} {{ $a->apellido_materno }}</p></div>
                                    <div><p class="font-semibold text-gray-800">Correo:</p><p>{{ $a->correo ?? $a->email ?? '-' }}</p></div>
                                    <div><p class="font-semibold text-gray-800">Teléfono:</p><p>{{ $a->telefono ?? '-' }}</p></div>
                                    <div><p class="font-semibold text-gray-800">Carrera:</p><p>{{ optional($a->carreraPrincipal)->nombre ?? '-' }}</p></div>
                                    <div><p class="font-semibold text-gray-800">Estado actual:</p>
                                        <span class="px-2 py-1 rounded-full text-xs
                                            {{ $a->status==='proceso' ? 'bg-yellow-100 text-yellow-700' :
                                            ($a->status==='contactado' ? 'bg-orange-100 text-orange-700' :
                                            ($a->status==='registrado' ? 'bg-green-100 text-green-700' :
                                            'bg-red-100 text-red-700')) }}">
                                            {{ strtoupper(str_replace('_',' ',$a->status)) }}
                                        </span>
                                    </div>
                                    <div><p class="font-semibold text-gray-800">Fecha de registro:</p><p>{{ optional($a->created_at)->format('d-m-Y') ?? '-' }}</p></div>
                                </div>

                                {{-- Cambiar estado --}}
                                <form method="POST" action="{{ route('admin.aspirantes.updateStatus', $a->id) }}" class="mt-6">
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

                                    <div class="mt-4 flex justify-end gap-3">
                                        
                                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                            Guardar cambios
                                        </button>
                                    </div>
                                </form>

                                {{-- Enviar correo --}}
                                <hr class="my-6">
                                <h3 class="text-lg font-semibold text-gray-700 mb-2">Enviar correo al aspirante</h3>
                                <form method="POST" action="{{ route('admin.aspirantes.enviarCorreo', $a->id) }}">
                                    @csrf
                                    <textarea id="mensaje-{{ $a->id }}" name="mensaje"
                                              rows="4"
                                              class="w-full border-gray-300 rounded-lg focus:ring-blue-200 focus:border-blue-500"
                                              placeholder="Escribe el contenido del correo..."></textarea>

                                    <div id="preview-{{ $a->id }}"
                                         class="mt-6 bg-gray-50 border border-gray-200 rounded-lg p-4 text-sm text-gray-700 leading-relaxed hidden">
                                        <p><strong>Hola {{ $a->nombre }},</strong></p>
                                        <p class="mensaje-preview"></p>
                                        <p class="mt-4">
                                            Atentamente,<br>
                                            Lic. Sandy Jazmin Manzo Haro<br>
                                            Depto. Vinculación<br>
                                            Universidad Politécnica de Bacalar
                                        </p>
                                    </div>

                                    <div class="mt-6 flex justify-end gap-3">
                                        <a href="https://wa.me/52{{ $a->telefono }}?text={{ urlencode('Hola '.$a->nombre.', te contactamos de la Universidad Politécnica de Bacalar sobre tu pre-registro en la carrera de '.(optional($a->carreraPrincipal)->nombre ?? 'tu elección').'.') }}"
                                           target="_blank"
                                           class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                                            💬 Enviar WhatsApp
                                        </a>
                                        <button type="submit"
                                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                            ✉️ Enviar correo
                                        </button>
                                    </div>
                                </form>

                                {{-- 📜 Historial de contactos --}}
                                <hr class="my-6">
                                <h3 class="text-lg font-semibold text-gray-700 mb-3">Historial de Contacto</h3>

                                @php
                                    $historial = \App\Models\HistorialContacto::where('aspirante_id', $a->id)
                                                ->orderByDesc('created_at')
                                                ->take(10)
                                                ->get();
                                @endphp

                                @if($historial->isEmpty())
                                    <p class="text-gray-500 text-sm">No hay registros de contacto todavía.</p>
                                @else
                                    <div class="max-h-48 overflow-y-auto border border-gray-200 rounded-lg p-3 bg-gray-50">
                                        @foreach($historial as $h)
                                            <div class="border-b last:border-0 py-2">
                                                <p class="text-xs text-gray-500">{{ $h->created_at->format('d/m/Y H:i') }} —
                                                    <span class="font-semibold {{ $h->tipo == 'correo' ? 'text-blue-600' : 'text-green-600' }}">
                                                        {{ strtoupper($h->tipo) }}
                                                    </span>
                                                </p>
                                                <p class="text-sm text-gray-700">{{ Str::limit($h->mensaje, 120) }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="9" class="px-4 py-4 text-center text-gray-500">No hay aspirantes registrados aún.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    <div class="mt-4">
        {{ $aspirantes->links() }}
    </div>

    {{-- Script general --}}
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
            document.addEventListener('keydown', e => {
                if (e.key === 'Escape') document.querySelectorAll('[id^="modal-"]').forEach(m => m.classList.add('hidden'));
            });

            document.querySelectorAll('[id^="mensaje-"]').forEach(textarea => {
                const id = textarea.id.split('-')[1];
                const previewBox = document.getElementById(`preview-${id}`);
                const mensajePreview = previewBox?.querySelector('.mensaje-preview');
                textarea.addEventListener('input', () => {
                    const value = textarea.value.trim();
                    if (value) {
                        previewBox.classList.remove('hidden');
                        mensajePreview.textContent = value;
                    } else {
                        previewBox.classList.add('hidden');
                    }
                });
            });
        });
    </script>
</x-admin-layout>
