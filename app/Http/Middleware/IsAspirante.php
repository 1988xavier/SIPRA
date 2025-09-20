<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAspirante
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Verificar si el aspirante está logueado
        if (!$request->session()->has('aspirante_id')) {
            return redirect()->route('aspirantes.login')
                ->withErrors(['error' => 'Debes iniciar sesión para acceder a esta sección.']);
        }

        return $next($request);
    }
}
