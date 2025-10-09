<x-admin-layout>
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow">
        <h1 class="text-2xl font-bold mb-6">Agregar Nuevo Coordinador</h1>

        <form action="{{ route('admin.administradores.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium">Nombre</label>
                <input type="text" name="name" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="block text-sm font-medium">Correo electrónico</label>
                <input type="email" name="email" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="block text-sm font-medium">Contraseña</label>
                <input type="password" name="password" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="block text-sm font-medium">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="block text-sm font-medium">Rol</label>
                <select name="role" class="w-full border rounded p-2" required>
                    <option value="coordinador">Coordinador</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium">Estado</label>
                <select name="status" class="w-full border rounded p-2" required>
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                </select>
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.administradores.index') }}" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Cancelar</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Guardar</button>
            </div>
        </form>
    </div>
</x-admin-layout>
