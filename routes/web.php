<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\conductorController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\VehiculoController;

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
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('conductor',ConductorController::class);
Route::get('/repo-conductor-xlsx',[ConductorController::class,'exportExcel'])->name('repo-conductor-xlsx');
Route::get('/repo-conductor-html',[ConductorController::class,'exportHtml'])->name('repo-conductor-html');
Route::get('/repo-conductor-pdf',[ConductorController::class,'downloadPDF'])->name('downloadPDF');

Route::resource('solicitud', SolicitudController::class);
Route::post('/solicitud/{solicitud}', [SolicitudController::class,'accepted'])->name('solicitud.accepted');

Route::resource('cliente', ClienteController::class);
Route::get('download', [ClienteController::class, 'downloadPDF'])->name('download-pdf');
Route::get('/repo-cliente-xlsx',[ClienteController::class,'exportExcel'])->name('repo-cliente-xlsx');
Route::get('/repo-cliente-html',[ClienteController::class,'exportHtml'])->name('repo-cliente-html');

Route::resource('usuario', UserController::class);




Route::resource('vehiculo', VehiculoController::class);
Route::put('estado/{estado}/update', [VehiculoController::class, 'estado'])->name('vehiculo.estado');
Route::get('pdf', [VehiculoController::class, 'pdf'])->name('vehiculo.pdf');
Route::get('bitacora', [VehiculoController::class, 'bitacora'])->name('bitacora');

require __DIR__.'/auth.php';
