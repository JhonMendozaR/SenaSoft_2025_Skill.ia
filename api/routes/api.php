<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// API - Rutas públicas
Route::post('/users/register', [AuthController::class, 'register']);
Route::post('/users/login', [AuthController::class, 'login']);

// API - Cerrar sesión, se requiere Bearer Token
Route::middleware(['auth:sanctum'])->post('/users/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    // API - Competencia
    Route::apiResource('competencias', \App\Http\Controllers\CompetenciaController::class)
        ->parameters([
            'competencias' => 'id'
        ]);

    // API - Evaluacion
    Route::apiResource('evaluaciones', \App\Http\Controllers\EvaluacionController::class)
        ->parameters([
            'evaluaciones' => 'id'
        ]);

    // API - Hito
    Route::apiResource('hitos', \App\Http\Controllers\HitoController::class)
        ->parameters([
            'hitos' => 'id'
        ]);

    // API - InteraccionesAgente
    Route::apiResource('interacciones_agente', \App\Http\Controllers\InteraccionAgenteController::class)
        ->parameters([
            'interacciones_agente' => 'id'
        ]);

    // API - PerfilObjetivo
    Route::apiResource('perfiles_objetivo', \App\Http\Controllers\PerfilObjetivoController::class)
        ->parameters([
            'perfiles_objetivo' => 'id'
        ]);

    // API - ProgresoUsuario
    Route::apiResource('progreso_usuario', \App\Http\Controllers\ProgresoUsuarioController::class)
        ->parameters([
            'progreso_usuario' => 'id'
        ]);

    // API - Recomendaciones
    Route::apiResource('recomendaciones', \App\Http\Controllers\RecomendacionController::class)
        ->parameters([
            'recomendaciones' => 'id'
        ]);

    // API - ResultadosEvaluacion
    Route::apiResource('resultados_evaluacion', \App\Http\Controllers\ResultadoEvaluacionController::class)
        ->parameters([
            'resultados_evaluacion' => 'id'
        ]);

    // API - RoadmapHito
    Route::apiResource('resultados_evaluacion', \App\Http\Controllers\ResultadoEvaluacionController::class)
        ->parameters([
            'resultados_evaluacion' => 'id'
        ]);

    // API - ResultadosEvaluacion
    Route::apiResource('resultados_evaluacion', \App\Http\Controllers\ResultadoEvaluacionController::class)
        ->parameters([
            'resultados_evaluacion' => 'id'
        ]);
});
