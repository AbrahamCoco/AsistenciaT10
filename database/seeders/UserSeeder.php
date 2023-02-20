<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Abraham Cocoletzi Zempoalteca',
            'fom' => '20192271',
            'telefono' => '5567633329',
            'tipo' => 'Servicio social',
            'fechaAgenda' => '2023-02-20',
            'ce' => 'CCZMAB95031629H700',
            'curp' => 'COZA950316HTLCMB02',
            'direccion' => 'Calle 23 de marzo #84, Secc 6ta, Contla de Juan Cuamatzi, Tlaxcala',
            'email' => '20192271@uatx.mx',
            'password' => Hash::make('zac950316'),
        ])->assignRole('Administrador');
    }
}
