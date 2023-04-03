<?php

namespace App\Http\Controllers;

use App\Models\HoraRegis;
use Illuminate\Support\Str;
use App\Models\Tipo;
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

        $asistencia->hora_inicio = Carbon::now('America/Mexico_City');
        $asistencia->hora_fin = null;
        $asistencia->horas_transcurridas = null;
        $asistencia->user_id = Auth()->user()->id;

        // Buscar el registro de Tipo correspondiente al usuario actual y obtener su ID
        $tipo = Tipo::where('user_id', Auth()->user()->id)
            ->where('tipo', 'Servicio Social')
            ->first();
        $asistencia->tipo_id = $tipo ? $tipo->id : null;

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

        return view('insertar-horas', compact('users', 'selected_user'));
    }

    public function search($user_id)
    {
        // Aquí puedes hacer lo que necesites con el valor de $user_id
        $user = User::findOrFail($user_id);
        $tipos = Tipo::select('id', 'tipo')->where('user_id', $user_id)->distinct()->get();

        return view('horas-registradas', ['id' => $user_id, 'user' => $user, 'tipos' => $tipos]);
    }

    public function tableHoras($user_id, $tipo_id)
    {
        $user = User::findOrFail($user_id);
        $tipo = Tipo::findOrFail($tipo_id);
        $horas = HoraRegis::where('user_id', $user_id)->where('tipo_id', $tipo_id)->get();

        return view('tablaHoras', compact('user', 'tipo', 'horas'));
    }

    public function insert(Request $request)
    {
        $hora_inicio = Carbon::createFromFormat('Y-m-d\TH:i', $request->entrada);
        $hora_fin = Carbon::createFromFormat('Y-m-d\TH:i', $request->salida);

        $horas_transcurridas = $hora_fin->diffInMinutes($hora_inicio) / 60;

        $hora = new HoraRegis();
        $hora->user_id = $request->input('user_id');
        $hora->tipo_id = $request->input('tipo_id');
        $hora->hora_ini = $request->input('entrada');
        $hora->hora_fin = $request->input('salida');
        $hora->horas_transcurridas = $horas_transcurridas;
        $hora->save();

        return redirect()->route('dynamic-input')->with('message', 'Hora Agregada con exito.');
    }
}
