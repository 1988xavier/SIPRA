<!-- resources/views/auth/login_aspirante.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Aspirante - UPB</title>
    @vite('resources/css/app.css')
</head>
<body class="relative min-h-screen flex flex-col items-center">

    <!-- Fondo con imagen solo arriba -->
    <div class="relative w-full h-1/2">
        <img src="{{ asset('images/upb1.jpg') }}" 
             alt="Universidad Politécnica de Bacalar"
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/40"></div>

        <!-- Logo dentro del fondo -->
        <div class="absolute inset-0  flex-col items-center justify-start text-white mt-6">
            <img src="{{ asset('images/logo_upb.png') }}" alt="UPB Logo" class="w-20 mb-2 drop-shadow-lg">
        </div>
    </div>

    <!-- Tarjeta de login debajo del fondo -->
    <div class="relative w-full max-w-sm -mt-12 bg-white rounded-xl shadow-lg p-6 mx-6">

        <form method="POST" action="{{ route('aspirantes.login') }}" class="space-y-4">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium">Email</label>
                <input id="email" type="email" name="email" required autofocus
                    class="w-full px-3 py-2 border rounded-lg focus:ring focus:ring-blue-200 focus:border-blue-500">
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium">Contraseña</label>
                <input id="password" type="password" name="password" required
                    class="w-full px-3 py-2 border rounded-lg focus:ring focus:ring-blue-200 focus:border-blue-500">
            </div>

            <!-- Botón -->
            <div>
                <button type="submit"
                    class="w-full py-2 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700">
                    LOGIN
                </button>
            </div>
        </form>

        <!-- Enlace a registro -->
        <p class="mt-4 text-center text-sm text-gray-600">
            ¿No tienes cuenta?
            <a href="{{ route('aspirantes.register') }}" class="text-blue-600 font-semibold hover:underline">
                Crea una aquí.
            </a>
        </p>
    </div>
</body>

</html>
