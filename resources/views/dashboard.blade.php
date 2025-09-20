<x-admin-layout>
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Panel de Control</h1>

    <!-- Tarjetas de resumen -->
    <div class="grid grid-cols-4 gap-6 mb-8">
        <div class="bg-gray-200 p-6 rounded-lg text-center">
            <h2 class="text-lg font-semibold">Aspirantes registrados</h2>
            <p class="text-3xl font-bold mt-2">{{ $registrados ?? 0 }}</p>
        </div>
        <div class="bg-gray-200 p-6 rounded-lg text-center">
            <h2 class="text-lg font-semibold">En proceso</h2>
            <p class="text-3xl font-bold mt-2">{{ $proceso ?? 0 }}</p>
        </div>
        <div class="bg-gray-200 p-6 rounded-lg text-center">
            <h2 class="text-lg font-semibold">Aceptados</h2>
            <p class="text-3xl font-bold mt-2">{{ $aceptados ?? 0 }}</p>
        </div>
        <div class="bg-gray-200 p-6 rounded-lg text-center">
            <h2 class="text-lg font-semibold">Rechazados</h2>
            <p class="text-3xl font-bold mt-2">{{ $rechazados ?? 0 }}</p>
        </div>
    </div>

    <!-- Gráficas simuladas -->
    <div class="grid grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold mb-4">Aspirantes por carreras</h2>
            <img src="{{ asset('images/grafica1.png') }}" alt="Gráfica de aspirantes">
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold mb-4">Tendencias de aceptación</h2>
            <img src="{{ asset('images/grafica2.png') }}" alt="Gráfica de aceptación">
        </div>
    </div>
</x-admin-layout>
