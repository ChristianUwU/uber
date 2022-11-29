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
Route::post('/repo-conductor-xlsx',[ConductorController::class,'export'])->name('repo-conductor');

Route::resource('solicitud', SolicitudController::class);
Route::post('/solicitud/{solicitud}', [SolicitudController::class,'accepted'])->name('solicitud.accepted');

Route::resource('cliente', ClienteController::class);
Route::post('/repo-cliente',[ClienteController::class,'export'])->name('repo-cliente');


Route::resource('usuario', UserController::class);




Route::resource('vehiculo', VehiculoController::class);
Route::put('estado/{estado}/update', [VehiculoController::class, 'estado'])->name('vehiculo.estado');
Route::get('pdf', [VehiculoController::class, 'pdf'])->name('vehiculo.pdf');
Route::get('bitacora', [VehiculoController::class, 'bitacora'])->name('bitacora');

require __DIR__.'/auth.php';
