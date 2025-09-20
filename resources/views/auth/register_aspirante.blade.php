<!-- resources/views/auth/register_aspirante.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Aspirante - UPB</title>
    @vite('resources/css/app.css')
</head>
<body class="relative min-h-screen flex flex-col items-center justify-center">

    <!-- Fondo -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/upb1.jpg') }}" class="w-full h-full object-cover" alt="">
        <div class="absolute inset-0 bg-black/40"></div>
    </div>

    <!-- Caja de registro -->
    <div class="relative w-full max-w-md bg-white rounded-xl shadow-lg p-6 mx-6">
        <h2 class="text-2xl font-bold text-center mb-4 text-gray-800">Registro de Aspirante</h2>

        <form method="POST" action="{{ route('aspirantes.register.store') }}" class="space-y-4">
            @csrf

            <!-- Nombre -->
            <div>
                <label class="block text-sm font-medium">Nombre</label>
                <input type="text" name="nombre" required class="w-full px-3 py-2 border rounded-lg">
            </div>

            <!-- Apellido paterno -->
            <div>
                <label class="block text-sm font-medium">Apellido paterno</label>
                <input type="text" name="apellido_paterno" required class="w-full px-3 py-2 border rounded-lg">
            </div>

            <!-- Apellido materno -->
            <div>
                <label class="block text-sm font-medium">Apellido materno</label>
                <input type="text" name="apellido_materno" required class="w-full px-3 py-2 border rounded-lg">
            </div>

            <!-- Fecha de nacimiento -->
            <div>
                <label class="block text-sm font-medium">Fecha de nacimiento</label>
                <input type="date" name="fecha_nacimiento" required class="w-full px-3 py-2 border rounded-lg">
            </div>

            <!-- Escuela de procedencia -->
            <div>
                <label class="block text-sm font-medium">Escuela de procedencia</label>
                <input type="text" name="escuela_procedencia" required class="w-full px-3 py-2 border rounded-lg">
            </div>

            <!-- Teléfono -->
            <div>
                <label class="block text-sm font-medium">Teléfono</label>
                <input type="tel" name="telefono" required class="w-full px-3 py-2 border rounded-lg">
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium">Email</label>
                <input type="email" name="email" required class="w-full px-3 py-2 border rounded-lg">
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium">Contraseña</label>
                <input type="password" name="password" required class="w-full px-3 py-2 border rounded-lg">
            </div>

            <!-- Confirmar Password -->
            <div>
                <label class="block text-sm font-medium">Confirmar contraseña</label>
                <input type="password" name="password_confirmation" required class="w-full px-3 py-2 border rounded-lg">
            </div>

            <!-- Aceptar términos -->
            <div class="flex items-center">
                <input type="checkbox" name="accepted_terms" required class="mr-2">
                <label class="text-sm text-gray-600">Acepto las políticas de privacidad y términos de uso</label>
            </div>

            <!-- Botón -->
            <div>
                <button type="submit"
                    class="w-full py-2 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700">
                    Crear cuenta
                </button>
            </div>
        </form>

        <p class="mt-4 text-center text-sm text-gray-600">
            ¿Ya tienes cuenta?
            <a href="{{ route('aspirantes.login') }}" class="text-blue-600 font-semibold hover:underline">
                Inicia sesión aquí
            </a>
        </p>
    </div>

</body>
</html>
