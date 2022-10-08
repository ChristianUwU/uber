<?php


use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CursoCtrl;

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
    return view('VistasAuth/Login');
});


/*
Route::get('cursos', [CursoCtrl::class, 'index']);
Route::get('cursos/create', [CursoCtrl::class, 'create']);
Route::get('cursos/{curso}', [CursoCtrl::class, 'show']);
*/

//forma mas limpia de agrupar nuestros controladores 
Route::controller(CursoCtrl::class)->group(function(){
    Route::get('cursos', 'index');
    Route::get('cursos/create', 'create');
    Route::get('cursos/{curso}', 'show');
});


Route::get('Login',[AuthController::class,'login'])
->name('Login');
Route::post('Login',[AuthController::class,'loginStore'])
     ->name('LoginStore');
Route::get('Dashboard',[AuthController::class,'dashboard'])
     ->name('Dashboard');
Route::post('Logout',[AuthController::class,'logout'])
     ->name('Logout');
