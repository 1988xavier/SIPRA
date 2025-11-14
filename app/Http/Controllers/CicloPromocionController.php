<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CicloPromocion;
use App\Models\Aspirante;
use Carbon\Carbon;

class CicloPromocionController extends Controller
{
    /**
     * Iniciar un nuevo ciclo
     */
    public function iniciarCiclo()
    {
        // Revisar si ya existe un ciclo activo
        $cicloActivo = CicloPromocion::where('estado', 'activo')->first();

        if ($cicloActivo) {
            return redirect()->back()->with('error', 'Ya hay un ciclo activo.');
        }

        // Crear nuevo ciclo
        CicloPromocion::create([
            'anio' => date('Y'),
            'fecha_inicio' => Carbon::now(),
            'estado' => 'activo'
        ]);

        return redirect()->back()->with('success', 'Ciclo de promoción iniciado.');
    }

    /**
     * Cerrar el ciclo activo
     */
    public function cerrarCiclo()
    {
        $cicloActivo = CicloPromocion::where('estado', 'activo')->first();

        if (!$cicloActivo) {
            return redirect()->back()->with('error', 'No hay un ciclo activo para cerrar.');
        }

        // Asignar ciclo_id a todos los aspirantes registrados en este ciclo
        Aspirante::whereNull('ciclo_id')->update([
            'ciclo_id' => $cicloActivo->id
        ]);

        // Cerrar ciclo
        $cicloActivo->update([
            'estado' => 'cerrado',
            'fecha_cierre' => Carbon::now()
        ]);

        return redirect()->back()->with('success', 'Ciclo cerrado correctamente.');
    }

    /**
     * Mostrar lista de ciclos pasados
     */
    public function historial()
    {
        $ciclos = CicloPromocion::orderBy('id', 'DESC')->get();
        return view('ciclos.historial', compact('ciclos'));
    }

    /**
     * Ver detalles de un ciclo específico
     */
    public function verCiclo($id)
    {
        $ciclo = CicloPromocion::findOrFail($id);
        $aspirantes = Aspirante::where('ciclo_id', $id)->get();

        return view('ciclos.detalle', compact('ciclo', 'aspirantes'));
    }
}
