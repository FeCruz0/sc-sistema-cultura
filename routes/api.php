<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Rotas públicas


//Rotas protegidas
Route::prefix('v1')->group(function () {

    // Rotas públicas (throttle para proteção básica)
    Route::middleware('throttle:60,1')->group(function () {
        // Ex.: Route::get('editais', [\App\Http\Controllers\EditalApiController::class, 'index']);
    });

    // Rotas protegidas por token (Sanctum)
    Route::middleware(['auth:sanctum', 'throttle:60,1'])->group(function () {
        Route::get('user', function (Request $request) {
            return $request->user();
        });

        // adicionar aqui outras rotas protegidas (agentes, inscrições, etc.)
        // Ex.: Route::apiResource('agentes', \App\Http\Controllers\Api\AgenteController::class);
    });
});