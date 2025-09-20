<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'SIPRA') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <!-- Este es el cuadro que envuelve login/register -->
    <div class="w-[400px] p-8 bg-white border border-gray-200 shadow-lg rounded-lg">

        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <img src="{{ asset('images/logo_upb.png') }}" alt="Logo UPB" class="h-20">
        </div>

        <!-- Aquí se inyecta el contenido -->
        {{ $slot }}
    </div>

</body>
</html>
