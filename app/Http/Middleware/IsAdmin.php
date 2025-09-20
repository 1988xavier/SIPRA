<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Si no está autenticado o no es admin, lo redirigimos
        if (!$user || $user->role !== 'admin') {
            return redirect()->route('dashboard')
                ->withErrors(['error' => 'No tienes permisos para acceder a esta sección.']);
        }

        return $next($request);
    }
}
