<?php

use App\Http\Controllers\pers_administrativo\EstacionamientoController;
use App\Http\Controllers\pers_administrativo\EstudianteController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::apiResource('estudiantes', EstudianteController::class);

Route::apiResource('estacionamiento', EstacionamientoController::class);
Route::get('estacionamiento/estudiante/{codigo}', [EstacionamientoController::class,'buscarEstudiante']);