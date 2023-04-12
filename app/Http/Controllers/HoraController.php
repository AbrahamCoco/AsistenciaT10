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

        // Obtener el tipo de servicio actual del usuario y asignarlo a la propiedad tipo_id
        $tipo = Auth()->user()->tipos()->latest()->first();
        $asistencia->tipo_id = $tipo ? $tipo->id : null;

        $asistencia->save();

        return redirect()->route('dashboard')->with('success', 'Bienvenido, registraste con exito tu hora de entrada');
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

    public function editarHoras($user_id, $tipo_id, HoraRegis $hora_id)
    {
        session(['hora_id' => $hora_id->id]);
        $editarHoras = HoraRegis::findOrFail($hora_id->id);
        $hora_inicio = Carbon::parse($editarHoras->hora_inicio)->format('d/m/Y h:i A');
        $hora_fin = Carbon::parse($editarHoras->hora_fin)->format('d/m/Y h:i A');
        return view('editarHora', compact('hora_inicio', 'hora_fin', 'user_id', 'tipo_id', 'hora_id'));
    }

    public function actualizarHoras(Request $request, $user_id, $tipo_id, $hora_id)
    {
        $hora_inicio = Carbon::createFromFormat('Y-m-d\TH:i', $request->entrada);
        $hora_fin = Carbon::createFromFormat('Y-m-d\TH:i', $request->salida);

        $horas_transcurridas = $hora_fin->diffInMinutes($hora_inicio) / 60;

        HoraRegis::where('id', $hora_id)
            ->where('user_id', $user_id)
            ->where('tipo_id', $tipo_id)
            ->update([
                'hora_inicio' => $request->entrada,
                'hora_fin' => $request->salida,
                'horas_transcurridas' => $horas_transcurridas,
            ]);

        return redirect()->route('insertar-horas')->with('message', 'Hora actualizada con éxito.');
    }

    public function insert(Request $request, $user_id, $tipo_id)
    {
        $hora_inicio = Carbon::createFromFormat('Y-m-d\TH:i', $request->entrada);
        $hora_fin = Carbon::createFromFormat('Y-m-d\TH:i', $request->salida);

        $horas_transcurridas = $hora_fin->diffInMinutes($hora_inicio) / 60;

        // Crear un nuevo registro en la base de datos
        HoraRegis::create([
            'hora_inicio' => $hora_inicio,
            'hora_fin' => $hora_fin,
            'horas_transcurridas' => $horas_transcurridas,
            'user_id' => $user_id,
            'tipo_id' => $tipo_id,
        ]);

        return redirect()->route('insertar-horas')->with('message', 'Hora Agregada con exito.');
    }

    public function delete($id)
    {
        $hora = HoraRegis::find($id);
        $hora->delete();

        return redirect()->route('insertar-horas')->with('message', 'Hora eliminado con éxito.');
    }
}
