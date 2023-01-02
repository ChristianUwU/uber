<?php

use App\Http\Controllers\API\AuthController as AuthApi;
use App\Http\Controllers\API\UserController as UserApi;
use App\Http\Controllers\API\ConductorController as ConducApi;
use App\Http\Controllers\API\SolicitudController as SolicitudApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthApi::class, 'register']);

Route::post('/login', [AuthApi::class, 'login']);


Route::post('/logout', [AuthApi::class, 'logout'])
    ->name('api.logout')
    ->middleware('auth:sanctum');

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::apiResource('user', UserApi::class)->middleware('auth:sanctum');
    Route::apiResource('conductor', ConducApi::class)->middleware('auth:sanctum');
    Route::apiResource('solicitud', SolicitudApi::class)->middleware('auth:sanctum');
    Route::post('solicitud/responder/{solicitud:id}', [SolicitudApi::class, 'responder']);
    Route::get('solicitud/envio/{user:id}', [SolicitudApi::class, 'sendRequest'])->name('solicitud.envio');
    
    Route::get('/user-detail', [UserApi::class, 'getDetail'])
    ->name('api.get_detail')
    ->middleware('auth:sanctum');

    Route::post('/user/restore/{user:id}', [UserApi::class, 'restore'])
    ->name('api.user_restore')
    ->middleware('auth:sanctum');
});



    
