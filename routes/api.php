<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// --- AÑADIDO: Importamos los dos controladores ---
use App\Http\Controllers\Api\ElementoInventarioController;
use App\Http\Controllers\Api\AuthController;


// --- AÑADIDO: Rutas públicas para registrarse e iniciar sesión ---
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


// --- AÑADIDO: Un grupo de rutas que requieren autenticación ---
Route::middleware('auth:sanctum')->group(function () {
    // Ruta para obtener la información del usuario autenticado
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Ruta para cerrar sesión
    Route::post('/logout', [AuthController::class, 'logout']);

    // Rutas del inventario (ahora están protegidas)
    Route::apiResource('/inventario', ElementoInventarioController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
});