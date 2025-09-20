<x-aspirante-layout>
    <div class="max-w-4xl mx-auto px-4 py-6">

        <!-- Encabezado -->
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/default-avatar.png') }}" 
                     alt="Foto aspirante" 
                     class="w-12 h-12 rounded-full object-cover border">
                <div>
                    <h2 class="font-bold text-gray-800 text-lg">
                        {{ auth('aspirante')->user()->nombre }} {{ auth('aspirante')->user()->apellido_paterno }}
                    </h2>
                    <p class="text-sm text-gray-500">
                        {{ auth('aspirante')->user()->escuela_procedencia }}
                    </p>
                </div>
            </div>
            <form method="POST" action="{{ route('aspirantes.logout') }}">
                @csrf
                <button type="submit" class="text-sm text-red-500 hover:underline">
                    Cerrar sesión
                </button>
            </form>
        </div>

        <!-- Mensaje -->
        <div class="bg-blue-100 text-blue-800 p-4 rounded-lg mb-6 text-center">
            Consulta las carreras disponibles y elige hasta <b>3</b> según tus intereses.
        </div>

        <!-- Filtros -->
        <div class="flex gap-2 mb-6 justify-center">
            <button class="px-4 py-2 bg-blue-600 text-white text-sm rounded-full hover:bg-blue-700">Becas</button>
            <button class="px-4 py-2 bg-green-600 text-white text-sm rounded-full hover:bg-green-700">Calendario</button>
            <button class="px-4 py-2 bg-purple-600 text-white text-sm rounded-full hover:bg-purple-700">Ubicación</button>
        </div>

        <!-- Lista de carreras -->
        <div class="grid gap-6">
            @foreach($carreras as $carrera)
                <div class="bg-white rounded-xl shadow-md overflow-hidden flex flex-col sm:flex-row">
                    <!-- Imagen -->
                    <img src="{{ $carrera->imagen_url ?? asset('images/default-career.jpg') }}" 
                         alt="{{ $carrera->nombre }}" 
                         class="w-full sm:w-40 h-40 object-cover">

                    <!-- Contenido -->
                    <div class="flex flex-col justify-between p-4 flex-1">
                        <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $carrera->nombre }}</h3>
                        <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $carrera->descripcion }}</p>

                        <a href="{{ route('aspirantes.carreras.show', $carrera->id) }}" 
                           class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 text-center">
                            Ver más
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</x-aspirante-layout>
