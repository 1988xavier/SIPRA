<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Aspirante;

class AspiranteAuthController extends Controller
{
    public function login(Request $request)
    {
        // Validar datos enviados
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Buscar aspirante por email
        $aspirante = Aspirante::where('email', $request->email)->first();

        // Verificar credenciales
        if ($aspirante && Hash::check($request->password, $aspirante->password)) {
            // Guardar aspirante en sesión manualmente
            $request->session()->put('aspirante_id', $aspirante->id);

            return redirect()->route('aspirantes.carreras');
        }

        // Si falla
        return back()->withErrors([
            'email' => 'Las credenciales no son válidas.',
        ]);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('aspirante_id');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('aspirantes.login');
    }
}
