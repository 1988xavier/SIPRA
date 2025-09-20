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
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 hover:text-blue-600">
                    <span class="inline-block w-5 text-center">🏠</span> <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.aspirantes.index') }}" class="flex items-center gap-2 hover:text-blue-600">
                    <span class="inline-block w-5 text-center">👥</span> <span>Aspirantes</span>
                </a>
                <a href="{{ route('admin.carreras.index') }}" class="flex items-center gap-2 hover:text-blue-600">
                    🎓 <span>Carreras</span>
                </a>

                <a href="{{ route('admin.reportes.index') }}" class="flex items-center gap-2 hover:text-blue-600">
                    📊 <span>Reportes</span>
                </a>

                <a href="{{ route('admin.administradores.index') }}" class="flex items-center gap-2 hover:text-blue-600">
                    👤 <span>Administradores</span>
                </a>

                <a href="{{ route('admin.calendario.index') }}" class="flex items-center gap-2 hover:text-blue-600">
                    🗓️ <span>Calendario</span>
                </a>

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
                    
                </h1>

                <!-- Barra de iconos -->
                <div class="flex items-center gap-4">
                    <!-- Notificaciones -->
                    <button class="rounded-full w-10 h-10 flex items-center justify-center bg-white shadow hover:bg-gray-100">
                        🔔
                    </button>

                   <!-- Usuario con dropdown -->
                    <div class="relative group">
                        <button class="flex items-center gap-2 rounded-full px-3 py-2 bg-white shadow hover:bg-gray-100">
                            👤 <span class="text-gray-700 font-medium">{{ Auth::user()->name ?? 'Usuario' }}</span>
                        </button>

                        <!-- Menú desplegable -->
                        <div class="absolute right-0 mt-2 w-40 bg-white border rounded shadow-lg hidden group-hover:block">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Perfil</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100">
                                    Cerrar sesión
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Aquí se inyecta el contenido de cada vista --}}
            {{ $slot }}
        </main>
    </div>

</body>
</html>
