<x-guest-layout>
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Pre-registro de aspirantes</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('aspirantes.store.public') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium">Nombre</label>
                <input type="text" name="nombre" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium">Apellido paterno</label>
                    <input type="text" name="apellido_paterno" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium">Apellido materno</label>
                    <input type="text" name="apellido_materno" class="w-full border rounded px-3 py-2">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium">Fecha de nacimiento</label>
                <input type="date" name="fecha_nacimiento" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block text-sm font-medium">Escuela de procedencia</label>
                <input type="text" name="escuela_procedencia" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block text-sm font-medium">Teléfono</label>
                <input type="text" name="telefono" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block text-sm font-medium">Correo electrónico</label>
                <input type="email" name="email" class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block text-sm font-medium">Contraseña</label>
                <input type="password" name="password" class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block text-sm font-medium">Carreras de interés (máx. 3)</label>
                <select name="carreras[]" multiple class="w-full border rounded px-3 py-2" required>
                    @foreach($carreras as $carrera)
                        <option value="{{ $carrera->id }}">{{ $carrera->nombre }}</option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 mt-1">Mantén presionada la tecla CTRL (o Command en Mac) para seleccionar varias.</p>
            </div>

            <div>
                <label class="inline-flex items-center">
                    <input type="checkbox" name="accepted_terms" value="1" required>
                    <span class="ml-2 text-sm">Acepto las políticas de privacidad y términos de uso</span>
                </label>
            </div>

            <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white rounded hover:bg-blue-700">
                Enviar pre-registro
            </button>
        </form>
    </div>
</x-guest-layout>
