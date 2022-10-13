<?php

use App\Http\Controllers\ConductorController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UserController;
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
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('conductor',ConductorController::class);
Route::resource('cliente', ClienteController::class);
Route::resource('usuario', UserController::class);

require __DIR__.'/auth.php';
