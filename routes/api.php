<?php

use App\Http\Controllers\API\AuthController as AuthApi;
use App\Http\Controllers\API\UserController as UserApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthApi::class, 'register']);

Route::post('/login', [AuthApi::class, 'login']);

Route::post('/logout', [AuthApi::class, 'logout'])
    ->name('api.logout')
    ->middleware('auth:sanctum');

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::apiResource('user', UserApi::class)->middleware('auth:sanctum');
    
    Route::get('/user-detail', [UserApi::class, 'getDetail'])
    ->name('api.get_detail')
    ->middleware('auth:sanctum');

    Route::post('/user/restore/{user:id}', [UserApi::class, 'restore'])
    ->name('api.user_restore')
    ->middleware('auth:sanctum');
});



    
