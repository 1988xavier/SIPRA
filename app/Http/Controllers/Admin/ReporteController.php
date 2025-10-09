<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aspirante;
use App\Models\Carrera;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AspirantesExport;

class ReporteController extends Controller
{
    public function index(Request $request)
    {
        $carreraId = $request->input('carrera_id');
        $estado = $request->input('estado');

        // Construimos la consulta con filtros dinámicos
        $aspirantesQuery = Aspirante::with('carreraPrincipal')->orderBy('created_at', 'desc');

        if ($carreraId) {
            $aspirantesQuery->where('carrera_principal_id', $carreraId);
        }

        if ($estado) {
            $aspirantesQuery->where('status', $estado);
        }

        $aspirantes = $aspirantesQuery->get();
        $carreras = Carrera::orderBy('nombre')->get();

        return view('admin.reportes.index', compact('aspirantes', 'carreras', 'carreraId', 'estado'));
    }

    public function exportar(Request $request)
    {
        $campos = $request->input('campos', []);
        $carreraId = $request->input('carrera_id');
        $estado = $request->input('estado');

        if (empty($campos)) {
            return back()->with('error', 'Debes seleccionar al menos un campo.');
        }

        // Filtro aplicado también al Excel exportado
        $query = Aspirante::with('carreraPrincipal')->orderBy('created_at', 'desc');

        if ($carreraId) {
            $query->where('carrera_principal_id', $carreraId);
        }

        if ($estado) {
            $query->where('status', $estado);
        }

        return Excel::download(new AspirantesExport($campos, $query), 'reporte_aspirantes.xlsx');
    }
}
