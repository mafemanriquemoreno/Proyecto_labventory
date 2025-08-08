<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ElementoInventarioController;
use App\Http\Controllers\Api\AuthController;
// --- AÑADIDO: Importamos los modelos que vamos a usar ---
use App\Models\Categoria;
use App\Models\Proveedor;

// Rutas públicas para registrarse e iniciar sesión
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Grupo de rutas que requieren autenticación
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);

    // Rutas del inventario (CRUD)
    Route::apiResource('/inventario', ElementoInventarioController::class);

    // --- AÑADIDO: Nuevas rutas para obtener los catálogos ---
    
    // Ruta para obtener todas las categorías
    Route::get('/categorias', function () {
        return Categoria::all();
    });

    // Ruta para obtener todos los proveedores
    Route::get('/proveedores', function () {
        return Proveedor::all();
    });
});
