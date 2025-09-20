<!-- resources/views/auth/login_admin.blade.php -->
<x-guest-layout>
    
        <h1 class="text-2xl font-bold text-center mb-6 text-gray-800">Login Administrador</h1>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Usuario -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Usuario</label>
                <input id="email" type="email" name="email" required autofocus
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <!-- Contraseña -->
            <div class="mt-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input id="password" type="password" name="password" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <!-- Botón -->
            <div class="mt-6">
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition">
                    Ingresar
                </button>
            </div>
        </form>
    
</x-guest-layout>
