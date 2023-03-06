<?php

namespace App\Http\Controllers;

use App\Models\HoraRegis;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HoraController extends Controller
{

    public function index()
    {
        $asis = HoraRegis::where('user_id', Auth::user()->id)->whereNull('hora_fin')->first();

        if ($asis != null) {
            return view('dashboard', compact('asis'));
        } else {
            return view('dashboard');
        }
    }


    public function store(Request $request)
    {
        $asistencia = new HoraRegis();

        $asistencia->user_id = Auth()->user()->id;
        $asistencia->hora_inicio = Carbon::now('America/Mexico_City');
        $asistencia->hora_fin = Null;
        $asistencia->horas_transcurridas = Null;

        $asistencia->save();

        return redirect()->route('dashboard');
    }

    public function updatehora($id)
    {
        $hora = HoraRegis::where('user_id', Auth()->user()->id)->whereNull('hora_fin')->find($id);

        if (!$hora) {
            return redirect()->route('dashboard')->with('error', 'No se puede actualizar esta hora.');
        }

        $hora->hora_fin = Carbon::now('America/Mexico_City');
        $hora->horas_transcurridas = $hora->hora_fin->diffInMinutes($hora->hora_inicio) / 60;
        $hora->save();

        return redirect()->route('dashboard')->with('success', 'Hora actualizada correctamente.');
    }

    public function formInsert(Request $request)
    {
        $users = User::pluck('name', 'id');
        $selected_user = $request->input('id_user');

        $horas = [];
        if ($selected_user) {
            $horas = HoraRegis::where('id_user', $selected_user)->get();
        }

        return view('Dynamic-Input', compact('users', 'selected_user', 'horas'));
    }


    public function insert(Request $request)
    {
        $hora_inicio = Carbon::createFromFormat('Y-m-d\TH:i', $request->entrada);
        $hora_fin = Carbon::createFromFormat('Y-m-d\TH:i', $request->salida);

        $horas_transcurridas = $hora_fin->diffInMinutes($hora_inicio) / 60;

        HoraRegis::create([
            'user_id' => $request->id_user,
            'hora_inicio' => $hora_inicio,
            'hora_fin' => $hora_fin,
            'hora_transcurridas' => $horas_transcurridas,
        ]);

        return redirect()->route('Dynamic-Input')->with('message', 'Hora Agregada con exito.');
    }
}
