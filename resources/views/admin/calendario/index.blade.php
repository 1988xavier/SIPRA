<x-admin-layout>
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-extrabold text-gray-800">Calendario Académico</h1>

        @if(Auth::user()->role === 'admin')
        <form method="POST" action="{{ route('admin.calendario.store') }}" class="flex flex-wrap gap-2">
            @csrf
            <input type="text" name="titulo" placeholder="Evento"
                   class="border rounded px-2 py-1 text-sm flex-1 min-w-[180px]" required>
            <input type="date" name="fecha" class="border rounded px-2 py-1 text-sm" required>
            <input type="time" name="hora" class="border rounded px-2 py-1 text-sm">
            <input type="text" name="lugar" placeholder="Lugar"
                   class="border rounded px-2 py-1 text-sm flex-1 min-w-[180px]">

            <select name="coordinador1" id="coordinador1"
        class="border rounded px-2 py-1 text-sm flex-1 min-w-[160px]" onchange="filtrarCoordinadores(1)">
    <option value="">Seleccionar coordinador 1</option>
    @foreach($coordinadores as $c)
        <option value="{{ $c->name }}">{{ $c->name }}</option>
    @endforeach
</select>

<select name="coordinador2" id="coordinador2"
        class="border rounded px-2 py-1 text-sm flex-1 min-w-[160px]" onchange="filtrarCoordinadores(2)">
    <option value="">Seleccionar coordinador 2</option>
    @foreach($coordinadores as $c)
        <option value="{{ $c->name }}">{{ $c->name }}</option>
    @endforeach
</select>

<select name="coordinador3" id="coordinador3"
        class="border rounded px-2 py-1 text-sm flex-1 min-w-[160px]">
    <option value="">Seleccionar coordinador 3</option>
    @foreach($coordinadores as $c)
        <option value="{{ $c->name }}">{{ $c->name }}</option>
    @endforeach
</select>


            <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded text-sm hover:bg-blue-700">
                + Añadir Evento
            </button>
        </form>
        @endif
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Calendario -->
        <div class="md:col-span-3 bg-white rounded-lg shadow p-4">
            <div class="flex justify-between items-center mb-4">
                <a href="{{ route('admin.calendario.index', [
                    'mes' => $inicio->copy()->subMonth()->month,
                    'anio' => $inicio->copy()->subMonth()->year
                ]) }}">⬅</a>

                <h2 class="text-lg font-semibold">
                    {{ $inicio->translatedFormat('F Y') }}
                </h2>

                <a href="{{ route('admin.calendario.index', [
                    'mes' => $inicio->copy()->addMonth()->month,
                    'anio' => $inicio->copy()->addMonth()->year
                ]) }}">➡</a>
            </div>

            <table class="w-full border text-center">
                <thead class="bg-gray-100">
                    <tr>
                        @foreach(['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo'] as $dia)
                            <th class="py-2">{{ $dia }}</th>
                        @endforeach
                    </tr>
                </thead>

                <tbody>
                    @php
                        $startOfWeek = $inicio->copy()->startOfWeek(Carbon\Carbon::MONDAY);
                        $endOfWeek = $fin->copy()->endOfWeek(Carbon\Carbon::SUNDAY);
                    @endphp

                    @for($date = $startOfWeek; $date <= $endOfWeek; $date->addWeek())
                        <tr>
                            @for($d = 0; $d < 7; $d++)
                                @php
                                    $current = $date->copy()->addDays($d);
                                    $eventoDelDia = $eventos->where('fecha', $current->toDateString());
                                @endphp

                                <td class="h-20 border align-top p-1 {{ $current->month != $mes ? 'bg-gray-50 text-gray-400' : '' }}">
                                    <div class="text-xs font-bold">{{ $current->day }}</div>

                                    @foreach($eventoDelDia as $ev)
                                        <div class="mt-1 text-xs bg-blue-100 text-blue-800 rounded px-1 text-left">
                                            <div class="font-semibold">{{ $ev->titulo }}</div>

                                            @if($ev->hora)
                                                <div>🕒 {{ \Carbon\Carbon::parse($ev->hora)->format('H:i') }}</div>
                                            @endif

                                            @if($ev->lugar)
                                                <div>📍 {{ $ev->lugar }}</div>
                                            @endif

                                            @if($ev->coordinador1 || $ev->coordinador2 || $ev->coordinador3)
                                                <div>👥
                                                    {{ collect([$ev->coordinador1, $ev->coordinador2, $ev->coordinador3])
                                                        ->filter()
                                                        ->join(', ') }}
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </td>
                            @endfor
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>

        <!-- Próximos eventos -->
<div>
    <h3 class="text-lg font-bold mb-3">Próximos Eventos De Promocion Academicax</h3>
    <div class="space-y-3">
        @forelse($proximos as $p)
            <div class="bg-white border rounded-lg p-4 shadow-sm text-sm leading-snug">
                <div class="flex justify-between items-center mb-1">
                    <span class="font-semibold text-blue-700">
                        📅 {{ \Carbon\Carbon::parse($p->fecha)->translatedFormat('d \\d\\e F') }}
                    </span>
                    @if($p->hora)
                        <span class="text-gray-600">🕒 {{ \Carbon\Carbon::parse($p->hora)->format('H:i') }}</span>
                    @endif
                </div>

                <div class="font-semibold text-gray-800">
                    🏫 {{ $p->titulo }}
                </div>

                @if($p->lugar)
                    <div class="text-gray-700">
                        📍 {{ $p->lugar }}
                    </div>
                @endif

                @php
                    $coordinadores = collect([$p->coordinador1, $p->coordinador2, $p->coordinador3])
                        ->filter()
                        ->join(', ');
                @endphp

                @if($coordinadores)
                    <div class="text-gray-700">
                        👥 {{ $coordinadores }}
                    </div>
                @endif
            </div>
        @empty
            <p class="text-gray-500 text-sm">No hay eventos próximos.</p>
        @endforelse
    </div>
</div>





    <script>
function filtrarCoordinadores(n) {
    const selects = [
        document.getElementById('coordinador1'),
        document.getElementById('coordinador2'),
        document.getElementById('coordinador3')
    ];

    // obtener valores seleccionados
    const seleccionados = selects.map(s => s.value).filter(v => v !== "");

    selects.forEach((sel, i) => {
        const valorActual = sel.value;
        Array.from(sel.options).forEach(opt => {
            if (opt.value === "") return; // siempre deja la opción vacía
            opt.hidden = seleccionados.includes(opt.value) && opt.value !== valorActual;
        });
    });
}
</script>

</x-admin-layout>
