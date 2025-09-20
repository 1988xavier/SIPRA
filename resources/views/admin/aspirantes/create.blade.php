<x-admin-layout>
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow">
        <h2 class="text-xl font-bold mb-4">Agregar nuevo aspirante</h2>

        <form action="{{ route('admin.aspirantes.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre') }}" required
                       class="w-full border rounded px-3 py-2">
                @error('nombre') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Apellido paterno</label>
                <input type="text" name="apellido_paterno" value="{{ old('apellido_paterno') }}" required
                    class="w-full border rounded px-3 py-2">
                @error('apellido_paterno') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Apellido materno</label>
                <input type="text" name="apellido_materno" value="{{ old('apellido_materno') }}" required
                    class="w-full border rounded px-3 py-2">
                @error('apellido_materno') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
            </div>


            <div class="mb-4">
                <label class="block text-sm font-medium">Correo</label>
                <input type="email" name="email" value="{{ old('correo') }}" required
                    class="w-full border rounded px-3 py-2">
                @error('correo') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
            </div>


            <div class="mb-4">
                <label class="block text-sm font-medium">Teléfono</label>
                <input type="text" name="telefono" value="{{ old('telefono') }}" required
                    class="w-full border rounded px-3 py-2">
                @error('telefono') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
            </div>


            <div class="mb-4">
                <label class="block text-sm font-medium">Contraseña</label>
                <input type="password" name="password" required
                    class="w-full border rounded px-3 py-2">
                @error('password') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Confirmar contraseña</label>
                <input type="password" name="password_confirmation" required
                    class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Carrera</label>
                <select name="carrera_principal_id" required
                        class="w-full border rounded px-3 py-2">
                    <option value="">-- Selecciona una carrera --</option>
                    @foreach($carreras as $c)
                        <option value="{{ $c->id }}">{{ $c->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('admin.aspirantes.index') }}"
                class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Cancelar</a>
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Guardar</button>
            </div>
        </form>
    </div>
</x-admin-layout>
