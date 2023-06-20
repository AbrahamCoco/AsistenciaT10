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
        $request->validate([
            'name' => 'required|regex:/^[A-Za-z\sÁÉÍÓÚáéíóú]+$/',
            'fom' => 'required|numeric|max:9999999999',
            'telefono' => 'required|numeric|max:9999999999',
            'ce' => 'required|alpha_num|max:18',
            'curp' => 'required|alpha_num|max:18',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ], [
            'name.required' => 'El campo Nombre es obligatorio.',
            'name.regex' => 'El campo Nombre solo debe contener letras.',
            'fom.required' => 'El campo Folio o Matricula es obligatorio.',
            'fom.numeric' => 'El campo Folio o Matricula solo debe contener números.',
            'fom.max' => 'El campo Folio o Matricula no debe superar los 10 dígitos.',
            'telefono.required' => 'El campo Teléfono es obligatorio.',
            'telefono.numeric' => 'El campo Teléfono solo debe contener números.',
            'telefono.max' => 'El campo Teléfono no debe superar los 10 dígitos.',
            'ce.required' => 'El campo Clave de Elector es obligatorio.',
            'ce.alpha_num' => 'El campo Clave de Elector solo debe contener caracteres alfanuméricos.',
            'ce.max' => 'El campo Clave de Elector no debe superar los 18 caracteres.',
            'curp.required' => 'El campo CURP es obligatorio.',
            'curp.alpha_num' => 'El campo CURP solo debe contener caracteres alfanuméricos.',
            'curp.max' => 'El campo CURP no debe superar los 18 caracteres.',
            'email.required' => 'El campo Email es obligatorio.',
            'email.email' => 'El campo Email debe ser una dirección de correo válida.',
            'password.required' => 'El campo Contraseña es obligatorio.',
            'password.min' => 'El campo Contraseña debe tener al menos 8 caracteres.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'fom' => $request->fom,
            'telefono' => $request->telefono,
            'fechaAgenda' => $request->fechaAgenda,
            'ce' => strtoupper($request->ce),
            'curp' => strtoupper($request->curp),
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

        return redirect()->route('PrestadoresServicio')->with('success', 'Usuario agregado con éxito.');
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

        return redirect()->route('PrestadoresServicio')->with('success', 'Usuario modificado con exito.');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('PrestadoresServicio')->with('success', 'Usuario eliminado con éxito.');
    }

    public function show()
    {
        $registro = User::paginate();

        return view('PrestadoresServicio', compact('registro'));
    }
}
