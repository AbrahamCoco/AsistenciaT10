<?php

namespace App\Http\Controllers;

use App\Models\HoraRegis;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
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

        $data = compact('asistencia');
        $pdf = PDF::loadView('ReporteHoras', $data);

        return $pdf->download('ReporteHoras.pdf');
    }
}
