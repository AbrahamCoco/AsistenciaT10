<?php

use App\Http\Controllers\HoraController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\RegistroController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    // Rutas para el registro   
    Route::get('/Registro/create', [RegistroController::class, 'create'])->name('Registro');
    Route::post('/Registro', [RegistroController::class, 'store'])->name('Registro.store');
    Route::get('/PrestadoresServicio', [RegistroController::class, 'show'])->name('PrestadoresServicio');
    Route::get('/Prestadores/{registro}/edit', [RegistroController::class, 'edit'])->name('Registro.edit');
    Route::put('/Prestadores/{registro}', [RegistroController::class, 'update'])->name('Registro.update');
    Route::get('/PrestadoresServicio/{id}', [RegistroController::class, 'delete'])->name('Registro.delete');

    // Rutas para la asistencia
    Route::get('/dashboard', [HoraController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/store', [HoraController::class, 'store'])->name('dashboard.horaInicio');
    Route::put('/updatehora/{id}', [HoraController::class, 'updatehora'])->name('dashboard.update');
    Route::get('/dynamic-input', [HoraController::class, 'formInsert'])->name('dynamic-input');
    Route::post('/dynamic-input/insert', [HoraController::class, 'insert'])->name('dynamic-input.insert');

    //Rutas para generar pdf's
    Route::get('/contrato/{id}', [PdfController::class, 'contrato'])->name('contrato');
    Route::get('/reporte/{user_id}', [PdfController::class, 'reportehoras'])->name('reportehoras');
    Route::get('/pdf_auxiliar/{id}', [PdfController::class, 'pdf_auxiliar'])->name('pdf_auxiliar');
});
