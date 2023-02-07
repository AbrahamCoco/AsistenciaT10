<?php

namespace App\Http\Controllers;

use App\Models\HoraRegis;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Jenssegers\Date\Date;

class PdfController extends Controller
{
    public function contrato($id)
    {
        $date = new Date();
        $fecha = $date->format('l d F Y');
        $registro = User::findOrFail($id);
        $pdf = PDF::loadView('Contrato', ['registro' => $registro, 'fecha' => $fecha]);
        return $pdf->download('Contrato.pdf');
    }

    public function reportehoras($user_id)
    {
        $asistencia = HoraRegis::where('user_id', $user_id)->with('user')->get();
        // $horas = [];
        // if (isset($asistencia[1])) {
        //     foreach ($asistencia as $asis) {
        //         if ($asis->hora_inicio && $asis->hora_fin) {
        //             $minutes = Carbon::parse($asis->hora_inicio)->diffInMinutes(Carbon::parse($asis->hora_fin));
        //             $horas[] = [
        //                 'horas' => floor($minutes / 60),
        //                 'minutos' => $minutes % 60
        //             ];
        //         }
        //     }
        // }
        $pdf = PDF::loadView('ReporteHoras', [
            'asistencia' => $asistencia,
            // 'horas' => $horas
        ]);
        return $pdf->download('ReporteHoras.pdf');
    }
}
