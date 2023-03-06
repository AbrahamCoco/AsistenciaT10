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
            'tipo' => 'Servicio Social',
            'fechaAgenda' => '2022-11-14',
            'ce' => 'CCZMAB95031629H700',
            'curp' => 'COZA950316HTLCMB02',
            'direccion' => 'Calle 23 de marzo #84, Secc 6ta, Contla de Juan Cuamatzi, Tlaxcala',
            'email' => 'abrahamterminus10@gmail.com',
            'password' => Hash::make('zac950316'),
        ])->assignRole('Administrador');

        User::create([
            'name' => 'Elizabeth Zarate Sanchez',
            'fom' => '6585178',
            'telefono' => '2461036500',
            'tipo' => 'Jovenes Construyendo el Futuro',
            'fechaAgenda' => '2019-09-09',
            'ce' => 'ZRSNEL98101629M200',
            'curp' => 'ZASE981016MTLRNL05',
            'direccion' => 'C. Progreso Norte #54 90800, Chiautempan, Tlax',
            'email' => 'eliterminus10@gmail.com',
            'password' => Hash::make('Estandar_0909*'),
        ])->assignRole('Administrador');
    }
}
