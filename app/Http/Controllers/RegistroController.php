<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class RegistroController extends Controller
{
    public function create()
    {
        return view('Registro');
    }

    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'fom' => $request->fom,
            'telefono' => $request->telefono,
            'fechaAgenda' => $request->fechaAgenda,
            'ce' => $request->ce,
            'curp' => $request->curp,
            'direccion' => $request->direccion,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Obtenemos el ID del usuario que queremos relacionar con un Tipo
        $userId = $user->id;

        // Creamos un Tipo relacionado con el usuario obtenido anteriormente
        Tipo::create([
            'user_id' => $userId,
            'tipo' => $request->tipo
        ]);

        if ($request->rol == "Administrador") {
            $user->assignRole('Administrador');
        } else {
            $user->assignRole('PrestadorDeServicio');
        }

        return redirect()->route('PrestadoresServicio')->with('message', 'Usuario agregado con éxito.');
    }

    public function edit(User $registro)
    {
        session(['user_id' => $registro->id]);
        return view('edit', compact('registro'));
    }

    public function update(Request $request, User $registro)
    {
        $user_id = $request->input('user_id');
        $user = User::find($user_id);
        $validatedData = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);
        $registro->name = $request->name;
        $registro->fom = $request->fom;
        $registro->telefono = $request->telefono;
        $registro->fechaAgenda = $request->fechaAgenda;
        $registro->ce = $request->ce;
        $registro->curp = $request->curp;
        $registro->direccion = $request->direccion;
        $registro->email = $request->email;
        $registro->password = Hash::make($request->password);

        // Obtenemos el ID del usuario que queremos relacionar con un Tipo
        $userId = $user->id;

        // Creamos un Tipo relacionado con el usuario obtenido anteriormente
        Tipo::create([
            'user_id' => $userId,
            'tipo' => $request->tipo
        ]);

        $registro->save();

        return redirect()->route('PrestadoresServicio')->with('message', 'Usuario modificado con exito.');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('PrestadoresServicio')->with('message', 'Usuario eliminado con éxito.');
    }

    public function show()
    {
        $registro = User::paginate();

        return view('PrestadoresServicio', compact('registro'));
    }
}
