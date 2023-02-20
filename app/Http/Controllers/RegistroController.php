<?php

namespace App\Http\Controllers;

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
        User::create([
            'name' => $request->name,
            'fom' => $request->fom,
            'telefono' => $request->telefono,
            'tipo' => $request->tipo,
            'fechaAgenda' => $request->fechaAgenda,
            'ce' => $request->ce,
            'curp' => $request->curp,
            'direccion' => $request->direccion,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ])->assignRole('PrestadorDeServicio');

        // $registro = new User();

        // $registro->name = $request->name;
        // $registro->fom = $request->fom;
        // $registro->telefono = $request->telefono;
        // $registro->tipo = $request->tipo;
        // $registro->fechaAgenda = $request->fechaAgenda;
        // $registro->ce = $request->ce;
        // $registro->curp = $request->curp;
        // $registro->direccion = $request->direccion;
        // $registro->email = $request->email;
        // $registro->password = Hash::make($request->password);

        // $registro->save();

        return redirect()->route('PrestadoresServicio')->with('message', 'Usuario agregado con exito.');
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
        $registro->tipo = $request->tipo;
        $registro->fechaAgenda = $request->fechaAgenda;
        $registro->ce = $request->ce;
        $registro->curp = $request->curp;
        $registro->direccion = $request->direccion;
        $registro->email = $request->email;
        $registro->password = Hash::make($request->password);

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
