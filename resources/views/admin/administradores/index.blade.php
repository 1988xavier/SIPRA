<x-admin-layout>
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-800">Administradores</h1>
            <p class="text-sm text-gray-500">Gestiona los usuarios y administradores</p>
        </div>
        <a href="{{ route('admin.administradores.create') }}" 
        class="px-4 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700">
        + Agregar Nuevo
        </a>

    </div>

    {{-- Barra de búsqueda --}}
    <form method="GET" class="mb-4">
        <div class="relative max-w-md">
            <span class="absolute left-3 top-2.5 text-gray-400">🔎</span>
            <input type="text" name="q" value="{{ $search ?? '' }}" placeholder="Buscar administradores por nombre o correo"
                   class="w-full pl-9 pr-3 py-2 rounded-full border border-gray-300 focus:ring-blue-200 focus:border-blue-500">
        </div>
    </form>

    {{-- Tabla --}}
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <th class="px-4 py-3 text-left">Nombre</th>
                    <th class="px-4 py-3 text-left">Correo electrónico</th>
                    <th class="px-4 py-3 text-left">Rol</th>
                    <th class="px-4 py-3 text-center">Estado</th>
                    <th class="px-4 py-3 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($administradores as $admin)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-800">{{ $admin->name }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $admin->email }}</td>
                        <td class="px-4 py-3 text-gray-700">
                            {{ $admin->role === 'admin' ? 'Administrador' : 'Editor' }}
                        </td>
                        <td class="px-4 py-3 text-center">
                        
                            <form action="{{ route('admin.administradores.updateEstado', $admin->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()" 
                                    class="text-xs rounded px-2 py-1 border
                                        {{ $admin->status === 'activo' ? 'bg-green-100 text-green-700 border-green-400' : 'bg-red-100 text-red-700 border-red-400' }}">
                                    <option value="activo" {{ $admin->status === 'activo' ? 'selected' : '' }}>Activo</option>
                                    <option value="inactivo" {{ $admin->status === 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                                </select>
                            </form>
                        </td>


                    <td class="px-4 py-3 text-center space-x-3">
                        {{-- <a href="{{ route('admin.administradores.edit', $admin->id) }}" class="text-blue-600 hover:underline">Editar</a> --}}
                        
                        <form action="{{ route('admin.administradores.destroy', $admin->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline"
                                    onclick="return confirm('¿Estás seguro de eliminar este administrador?')">
                                Eliminar
                            </button>
                        </form>
                    </td>


                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                            No hay administradores registrados aún.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    <div class="mt-4">
        {{ $administradores->links() }}
    </div>
</x-admin-layout>
