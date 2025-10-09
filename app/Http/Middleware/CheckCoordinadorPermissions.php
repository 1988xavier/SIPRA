<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class CheckCoordinadorPermissions
{
    public function handle(Request $request, Closure $next)
{
    $user = auth()->user();

    if (!$user) {
        return $next($request);
    }

    // Solo si es coordinador
    if ($user->role === 'coordinador') {
        $routeName = Route::currentRouteName();

        // Solo puede acceder a estas rutas
        $permitidos = [
            'admin.reportes.*',
            'admin.calendario.*',
            'dashboard', // opcional, por si ves el panel principal
        ];

        // Si no está en la lista permitida → bloquear acceso
        if (!$this->matchesAllowed($routeName, $permitidos)) {
            return redirect()->route('admin.reportes.index')
                ->withErrors(['error' => 'No tienes permiso para acceder a esta sección.']);
        }

        // Si intenta hacer algo que no sea ver (GET) → bloquear también
        if (!$request->isMethod('GET') && !$this->matchesAllowed($routeName, $permitidos)) {
            return back()->withErrors(['error' => 'No tienes permiso para realizar esta acción.']);
        }
    }

    return $next($request);
}


    private function matchesAllowed(string $routeName, array $permitidos)
    {
        foreach ($permitidos as $patron) {
            $pattern = str_replace('*', '.*', $patron);
            if (preg_match("/^$pattern$/", $routeName)) {
                return true;
            }
        }
        return false;
    }
}
