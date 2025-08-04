<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// --- AÑADIDO: Importamos los modelos y helpers que vamos a usar ---
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Maneja el registro de un nuevo usuario.
     */
    public function register(Request $request)
    {
        // Validamos que nos envíen nombre, email y contraseña
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Creamos el nuevo usuario en la base de datos
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Encriptamos la contraseña
        ]);

        // Devolvemos una respuesta exitosa
        return response()->json([
            'message' => 'Usuario registrado exitosamente!'
        ], 201);
    }

    /**
     * Maneja el inicio de sesión de un usuario.
     */
    public function login(Request $request)
    {
        // Validamos que nos envíen email y contraseña
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Buscamos al usuario por su email
        $user = User::where('email', $request->email)->first();

        // Verificamos si el usuario existe y si la contraseña es correcta
        if (! $user || ! Hash::check($request->password, $user->password)) {
            // Si no es correcto, lanzamos un error de autenticación
            throw ValidationException::withMessages([
                'email' => ['Las credenciales proporcionadas son incorrectas.'],
            ]);
        }

        // Si todo es correcto, creamos un token (la tarjeta de acceso)
        $token = $user->createToken('auth_token')->plainTextToken;

        // Devolvemos el token al usuario
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    /**
     * Maneja el cierre de sesión de un usuario.
     */
    public function logout(Request $request)
    {
        // Revocamos el token actual del usuario para que ya no sea válido
        $request->user()->currentAccessToken()->delete();

        // Devolvemos una respuesta exitosa
        return response()->json([
            'message' => 'Sesión cerrada exitosamente'
        ]);
    }
}