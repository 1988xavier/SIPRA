<x-admin-layout>
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-extrabold text-gray-800">Calendario Académico</h1>
        <form method="POST" action="{{ route('admin.calendario.store') }}" class="flex gap-2">
            @csrf
            <input type="text" name="titulo" placeholder="Título del evento"
                   class="border rounded px-2 py-1 text-sm" required>
            <input type="date" name="fecha" class="border rounded px-2 py-1 text-sm" required>
            <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded text-sm hover:bg-blue-700">
                + Añadir Evento
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Calendario -->
        <div class="md:col-span-3 bg-white rounded-lg shadow p-4">
            <div class="flex justify-between items-center mb-4">
                <a href="{{ route('admin.calendario.index',['mes'=>$inicio->copy()->subMonth()->month,'anio'=>$inicio->copy()->subMonth()->year]) }}">⬅</a>
                <h2 class="text-lg font-semibold">
                    {{ $inicio->translatedFormat('F Y') }}
                </h2>
                <a href="{{ route('admin.calendario.index',['mes'=>$inicio->copy()->addMonth()->month,'anio'=>$inicio->copy()->addMonth()->year]) }}">➡</a>
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
                                    $eventoDelDia = $eventos->where('fecha',$current->toDateString());
                                @endphp
                                <td class="h-20 border align-top p-1 {{ $current->month != $mes ? 'bg-gray-50 text-gray-400' : '' }}">
                                    <div class="text-xs font-bold">{{ $current->day }}</div>
                                    @foreach($eventoDelDia as $ev)
                                        <div class="mt-1 text-xs bg-blue-100 text-blue-700 rounded px-1">
                                            {{ $ev->titulo }}
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
            <h3 class="text-lg font-bold mb-3">Próximos Eventos</h3>
            <div class="space-y-3">
                @forelse($proximos as $p)
                    <div class="bg-gray-100 p-3 rounded shadow-sm">
                        <div class="text-sm font-semibold">{{ \Carbon\Carbon::parse($p->fecha)->format('d M') }}</div>

                        <div class="text-xs text-gray-600">{{ $p->titulo }}</div>
                    </div>
                @empty
                    <p class="text-gray-500 text-sm">No hay eventos próximos.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-admin-layout>
