
<x-guest-layout>
    <div class="p-4">
        <h1 class="text-xl font-bold text-gray-800 mb-4">Carreras disponibles</h1>

        <div class="space-y-4">
            @foreach($carreras as $c)
                <div class="bg-white rounded-xl shadow overflow-hidden">
                    <!-- Imagen -->
                    @if($c->imagenes)
                        @php $img = json_decode($c->imagenes)[0] ?? null; @endphp
                        @if($img)
                            <img src="{{ asset('storage/'.$img) }}" alt="{{ $c->nombre }}" class="w-full h-40 object-cover">
                        @endif
                    @endif

                    <!-- Contenido -->
                    <div class="p-4">
                        <h2 class="text-lg font-semibold">{{ $c->nombre }}</h2>
                        <p class="text-sm text-gray-600">
                            {{ Str::limit($c->descripcion, 120) }}
                        </p>

                        <a href="{{ route('carreras.show.public', $c->slug) }}"
                           class="mt-3 inline-block px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Ver más
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-guest-layout>
