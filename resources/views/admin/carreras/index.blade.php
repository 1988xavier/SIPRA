<x-admin-layout>
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-800">Gestión de Carreras</h1>
        </div>
        {{-- Botón Crear Carrera --}}
        <a href="{{ route('admin.carreras.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm font-semibold">
            + Crear Carrera
        </a>
    </div>

  

    {{-- Cards de carreras --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($carreras as $c)
            <div class="bg-white rounded-lg shadow p-4 flex flex-col justify-between hover:shadow-lg transition">

                {{-- Multimedia carrusel --}}
                @php
                    $multimedia = $c->multimedia;
                @endphp

                @if($multimedia->count())
                    <div x-data="{ current: 0, items: {{ $multimedia->pluck('ruta') }} }" class="relative w-full mb-3">
                        <div class="overflow-hidden rounded-lg h-48">
                            <template x-for="(item, index) in items" :key="index">
                                <template x-if="current === index">
                                    <div class="w-full h-48">
                                        <template x-if="item.endsWith('.mp4') || item.endsWith('.avi') || item.endsWith('.mov')">
                                            <video controls class="w-full h-48 object-cover">
                                                <source :src="'/storage/' + item" type="video/mp4">
                                                Tu navegador no soporta video.
                                            </video>
                                        </template>
                                        <template x-if="!(item.endsWith('.mp4') || item.endsWith('.avi') || item.endsWith('.mov'))">
                                            <img :src="'/storage/' + item" class="w-full h-48 object-cover" alt="Imagen de {{ $c->nombre }}">
                                        </template>
                                    </div>
                                </template>
                            </template>
                        </div>

                        {{-- Flechas --}}
                        <button @click="current = current === 0 ? items.length - 1 : current - 1"
                                class="absolute top-1/2 left-2 transform -translate-y-1/2 bg-gray-800 text-white px-2 py-1 rounded z-10">‹</button>
                        <button @click="current = current === items.length - 1 ? 0 : current + 1"
                                class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-gray-800 text-white px-2 py-1 rounded z-10">›</button>

                        {{-- Indicadores --}}
                        <div class="flex justify-center mt-2 space-x-1">
                            <template x-for="(item, index) in items" :key="index">
                                <span @click="current = index"
                                      :class="current === index ? 'bg-blue-600' : 'bg-gray-300'"
                                      class="w-2 h-2 rounded-full inline-block cursor-pointer"></span>
                            </template>
                        </div>
                    </div>
                @else
                    <div class="w-full h-48 bg-gray-100 flex items-center justify-center text-gray-400 rounded-lg mb-3">
                        Sin multimedia
                    </div>
                @endif

                {{-- Contenido --}}
                <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $c->nombre }}</h2>
                <p class="text-gray-600 mb-3">{{ Str::limit($c->descripcion, 120) }}</p>

                {{-- Estado y acciones en la misma fila --}}
                <div class="mt-2 flex justify-between items-center">
                    

                    {{-- Botones a la derecha --}}
                    <div class="flex gap-2">
                        {{-- Botón Editar --}}
                        <a href="{{ route('admin.carreras.edit', $c) }}"
                           class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500 text-sm font-semibold">
                            Editar
                        </a>
                        {{-- Botón Eliminar --}}
                        <form action="{{ route('admin.carreras.destroy', $c) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    onclick="return confirm('¿Seguro que deseas eliminar esta carrera?')"
                                    class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 text-sm font-semibold">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center text-gray-500 py-10">
                No hay carreras registradas aún.
            </div>
        @endforelse
    </div>

    {{-- Paginación --}}
    <div class="mt-6">
        {{ $carreras->links() }}
    </div>

    {{-- Alpine.js --}}
    <script src="//unpkg.com/alpinejs" defer></script>
</x-admin-layout>
