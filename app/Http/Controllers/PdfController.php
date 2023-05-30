<?php

namespace App\Http\Controllers;

use App\Models\HoraRegis;
use App\Models\Tipo;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Jenssegers\Date\Date;

class PdfController extends Controller
{
    public function contrato($id)
    {
        $date = new Date();
        $fecha = $date->format('l d F Y');
        $registro = User::findOrFail($id);
        $tipo = Tipo::where('user_id', $id)->with('user')->first();
        $pdf = PDF::loadView('Contrato', ['registro' => $registro, 'fecha' => $fecha, 'tipo' => $tipo->tipo]);
        return $pdf->download('Contrato.pdf');
    }

    public function reportehoras($user_id)
    {
        $asistencia = HoraRegis::where('user_id', $user_id)->with('user')->get();

        if ($asistencia->isEmpty()) {
            // Si no hay datos de asistencia, redirige a la vista con un mensaje de error
            return redirect()->back()->with('error', 'No se encontraron datos de asistencia. No puedes descargar el reporte PDF');
        } else {
            $data = compact('asistencia');
            $pdf = PDF::loadView('ReporteHoras', $data);

            return $pdf->download('ReporteHoras.pdf');
        }
    }

    public function reporteEspecial(Request $request, $user_id)
    {
        $fecha_inicio = $request->input('fecha_inicio');
        $fecha_fin = $request->input('fecha_fin');

        $asistencias = HoraRegis::where('user_id', $user_id)
            ->whereBetween('hora_inicio', [$fecha_inicio, $fecha_fin])
            ->get();

        $asistencia = HoraRegis::where('user_id', $user_id)->with('user')->get();

        // Validar si no hay datos en $asistencia y $asistencias
        if ($asistencia->isEmpty() && $asistencias->isEmpty()) {
            return redirect()->back()->with('error', 'No hay datos de asistencia disponibles.');
        } else {
            $data = compact('asistencias', 'asistencia');

            $pdf = PDF::loadView('reporte-especial', $data);

            return $pdf->download('ReporteEspecial.pdf');
        }
    }
}
