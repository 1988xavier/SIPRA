<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdministradorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->string('q')->toString();

        $query = User::query()->whereIn('role', ['admin', 'editor']);

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $administradores = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        return view('admin.administradores.index', compact('administradores', 'search'));
    }




    public function create()
    {
        return view('admin.administradores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:admin,editor',
            'status' => 'required|string'
        ]);

        \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.administradores.index')->with('success', 'Administrador creado correctamente.');
    }




    public function updateEstado(Request $request, \App\Models\User $user)
{
    $request->validate([
        'status' => 'required|in:activo,inactivo',
    ]);

    $user->update([
        'status' => $request->status,
    ]);

    return back()->with('success', 'Estado actualizado correctamente.');
}



public function destroy(\App\Models\User $user)
{
    // Opcional: evitar que se elimine al administrador principal (id=1, por ejemplo)
    if ($user->id === 1) {
        return back()->withErrors(['error' => 'No puedes eliminar al administrador principal.']);
    }

    $user->delete();

    return back()->with('success', 'Administrador eliminado correctamente.');
}


}
