<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'SIPRA') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    <div class="flex min-h-screen">
        {{-- Sidebar global --}}
        <aside class="hidden md:block w-64 bg-white shadow-md">
            <div class="p-6 text-center border-b">
                <img src="{{ asset('images/logo_upb.png') }}" alt="Logo" class="h-20 mx-auto">
            </div>

            <nav class="p-6 space-y-3 text-gray-700">
                {{-- Dashboard: todos pueden verlo --}}
                <a href="{{ route('dashboard') }}"
                class="flex items-center gap-2 px-2 py-1 rounded-md {{ request()->routeIs('dashboard') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:text-blue-600' }}">
                    <span class="inline-block w-5 text-center">🏠</span> <span>Dashboard</span>
                </a>

    

                {{-- Módulos visibles según el rol --}}
@if(Auth::user()->role === 'admin')
    <a href="{{ route('admin.aspirantes.index') }}" class="flex items-center gap-2 hover:text-blue-600">
        👥 <span>Aspirantes</span>
    </a>
    <a href="{{ route('admin.carreras.index') }}" class="flex items-center gap-2 hover:text-blue-600">
        🎓 <span>Carreras</span>
    </a>
    <a href="{{ route('admin.administradores.index') }}" class="flex items-center gap-2 hover:text-blue-600">
        👤 <span>Administradores</span>
    </a>
    <a href="{{ route('admin.reportes.index') }}" class="flex items-center gap-2 hover:text-blue-600">
        📊 <span>Reportes</span>
    </a>
    <a href="{{ route('admin.calendario.index') }}" class="flex items-center gap-2 hover:text-blue-600">
        🗓️ <span>Calendario Promoción</span>
    </a>
    <a href="{{ route('admin.calendario_aspirantes.index') }}" class="flex items-center gap-2 hover:text-blue-600">
    📅 <span>Calendario de Aspirantes</span>
    </a>


@elseif(Auth::user()->role === 'coordinador')
    <a href="{{ route('coordinador.reportes.index') }}" class="flex items-center gap-2 hover:text-blue-600">
        📊 <span>Reportes</span>
    </a>
    <a href="{{ route('coordinador.calendario.index') }}" class="flex items-center gap-2 hover:text-blue-600">
        🗓️ <span>Calendario</span>
    </a>
@endif



<li>
    <a href="{{ route('ciclos.historial') }}"
        class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-200">
        
        <!-- Icono -->
        <svg xmlns="http://www.w3.org/2000/svg" 
             fill="none" viewBox="0 0 24 24" 
             stroke-width="1.5" stroke="currentColor" 
             class="w-5 h-5 text-gray-700">
            <path stroke-linecap="round" stroke-linejoin="round" 
                  d="M12 6v6l4 2m6-2a10 10 0 11-20 0 10 10 0 0120 0z" />
        </svg>

        <!-- Texto -->
        Historial
    </a>
</li>




                {{-- Cerrar sesión --}}
                <form method="POST" action="{{ route('logout') }}" class="pt-6">
                    @csrf
                    <button class="flex items-center gap-2 text-red-600 hover:text-red-700">
                        <span class="inline-block w-5 text-center">↪</span> <span>Cerrar sesión</span>
                    </button>
                </form>
            </nav>
        </aside>

        {{-- Contenido dinámico --}}
        <main class="flex-1 p-6 md:p-8">
            {{-- Encabezado superior con título dinámico + iconos --}}
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-gray-800">
                    {{ $header ?? '' }}
                </h1>

                <!-- Barra de iconos -->
                <div class="flex items-center gap-4">
                    <!-- Notificaciones -->
                    
                    <!-- Usuario con dropdown -->
                    <div class="relative group">
                        <button class="flex items-center gap-2 rounded-full px-3 py-2 bg-white shadow hover:bg-gray-100">
                            👤 <span class="text-gray-700 font-medium">{{ Auth::user()->name ?? 'Usuario' }}</span>
                        </button>

                       
                    </div>
                </div>
            </div>

            {{-- Aquí se inyecta el contenido de cada vista --}}
            {{ $slot }}
        </main>
    </div>

</body>
</html>
