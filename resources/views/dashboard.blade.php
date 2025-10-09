<x-admin-layout> 
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Panel de Control</h1>

    <!-- Tarjetas de resumen -->
    <div class="grid grid-cols-4 gap-6 mb-8">
        <div class="bg-gray-200 p-6 rounded-lg text-center">
            <h2 class="text-lg font-semibold">En proceso</h2>
            <p class="text-3xl font-bold mt-2">{{ $proceso ?? 0 }}</p>
        </div>
        <div class="bg-gray-200 p-6 rounded-lg text-center">
            <h2 class="text-lg font-semibold">Contactados</h2>
            <p class="text-3xl font-bold mt-2">{{ $contactados ?? 0 }}</p>
        </div>
        <div class="bg-gray-200 p-6 rounded-lg text-center">
            <h2 class="text-lg font-semibold">Registrados</h2>
            <p class="text-3xl font-bold mt-2">{{ $registrados ?? 0 }}</p>
        </div>
        <div class="bg-gray-200 p-6 rounded-lg text-center">
            <h2 class="text-lg font-semibold">No registrados</h2>
            <p class="text-3xl font-bold mt-2">{{ $noRegistrados ?? 0 }}</p>
        </div>
    </div>

    <!-- Contenedor de gráficas lado a lado -->
    <div class="grid grid-cols-2 gap-6">
        <!-- Gráfica de aspirantes por carrera -->
        <div class="bg-white p-8 rounded-lg shadow-md h-[32rem] flex items-center justify-center">
            <div class="w-full h-4/5">
                <h2 class="text-lg font-semibold mb-4 text-center">Aspirantes por carreras</h2>
                <canvas id="carrerasChart" class="w-full h-full"></canvas>
            </div>
        </div>

        <!-- Gráfica de estados -->
        <div class="bg-white p-8 rounded-lg shadow-md h-[32rem] flex items-center justify-center">
            <div class="w-full h-4/5">
                <h2 class="text-lg font-semibold mb-4 text-center">Tendencias de aceptación</h2>
                <canvas id="estadosChart" class="w-full h-full"></canvas>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
    // Carreras (Gráfica de barras horizontal)
    const labelsCarreras = @json($labelsCarreras);
    const dataCarreras   = @json($dataCarreras);

    new Chart(document.getElementById('carrerasChart'), {
        type: 'bar',
        data: {
            labels: labelsCarreras,
            datasets: [{
                label: 'Aspirantes',
                data: dataCarreras,
                backgroundColor: '#3b82f6'
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        precision: 0,
                        autoSkip: false,
                        callback: function (value) {
                            return value;
                        }
                    }
                },
                y: {
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });

    // Estados (Gráfica circular)
    const labelsEstados = ["En proceso", "Contactados", "Registrados", "No registrados"];
    const dataEstados   = [
        {{ $proceso ?? 0 }},
        {{ $contactados ?? 0 }},
        {{ $registrados ?? 0 }},
        {{ $noRegistrados ?? 0 }}
    ];

    new Chart(document.getElementById('estadosChart'), {
        type: 'pie',
        data: {
            labels: labelsEstados,
            datasets: [{
                data: dataEstados,
                backgroundColor: ['#facc15', '#fb923c', '#22c55e', '#ef4444'] // amarillo, naranja, verde, rojo
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
    </script>

</x-admin-layout>
