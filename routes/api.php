<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Points de Registro y Autenticacion

Route::post('Registro',[AuthController::class,'registro']);
Route::post('Login',[AuthController::class,'login']);
// Route::get('All',[AuthController::class,'all']);
