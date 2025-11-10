<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdministradorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->string('q')->toString();

        // ✅ Mostrar tanto el super admin como los coordinadores
        $query = User::query()->whereIn('role', ['admin', 'coordinador']);

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $administradores = $query->orderByRaw("FIELD(role, 'admin', 'coordinador')")
                                 ->orderBy('created_at', 'desc')
                                 ->paginate(10)
                                 ->withQueryString();

        return view('admin.administradores.index', compact('administradores', 'search'));
    }

    public function create()
    {
        return view('admin.administradores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|string|min:6|confirmed',
            'role'      => 'required|in:coordinador', // 🔹 Solo se pueden crear coordinadores
            'status'    => 'required|in:activo,inactivo'
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
            'status'   => $request->status,
        ]);

        return redirect()->route('admin.administradores.index')
                         ->with('success', 'Coordinador creado correctamente.');
    }

    public function updateEstado(Request $request, User $user)
    {
        $request->validate([
            'status' => 'required|in:activo,inactivo',
        ]);

        // 🚫 No permitir cambiar estado del super admin (role=admin)
        if ($user->role === 'admin') {
            return back()->withErrors(['error' => 'No puedes cambiar el estado del Super Administrador.']);
        }

        $user->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Estado actualizado correctamente.');
    }

    public function destroy(User $administradore)
{
    // No permitir eliminar al super admin
    if ($administradore->role === 'admin') {
        return back()->withErrors(['error' => 'No puedes eliminar al Super Administrador.']);
    }

    // Eliminar coordinador
    $administradore->delete();

    return back()->with('success', 'Coordinador eliminado correctamente.');
}

}
