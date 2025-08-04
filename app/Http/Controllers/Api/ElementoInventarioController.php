<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ElementoInventario;
use Illuminate\Support\Facades\Validator;

class ElementoInventarioController extends Controller
{
    /**
     * Muestra una lista de todos los elementos del inventario.
     */
    public function index()
    {
        $inventario = ElementoInventario::with(['categoria', 'proveedor'])->get();
        return response()->json($inventario);
    }

    /**
     * Guarda un nuevo elemento en la base de datos.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre_elemento' => 'required|string|max:255',
            'lote' => 'nullable|string|max:50',
            'marca' => 'nullable|string|max:50',
            'existencias_elemento' => 'required|integer|min:0',
            'laboratorio_id' => 'required|exists:laboratorio,id',
            'categoria_id' => 'required|exists:categorias,id',
            'proveedor_id' => 'required|exists:proveedores,id',
            'fecha_vencimiento' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $elemento = ElementoInventario::create($validator->validated());

        return response()->json($elemento, 201);
    }

    /**
     * Muestra un único elemento del inventario.
     */
    public function show(ElementoInventario $inventario)
    {
        return response()->json($inventario->load(['categoria', 'proveedor']));
    }

    /**
     * Actualiza un elemento existente en la base de datos.
     */
    public function update(Request $request, ElementoInventario $inventario)
    {
        $validator = Validator::make($request->all(), [
            'nombre_elemento' => 'string|max:255',
            'lote' => 'nullable|string|max:50',
            'marca' => 'nullable|string|max:50',
            'existencias_elemento' => 'integer|min:0',
            'laboratorio_id' => 'exists:laboratorio,id',
            'categoria_id' => 'exists:categorias,id',
            'proveedor_id' => 'exists:proveedores,id',
            'fecha_vencimiento' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $inventario->update($validator->validated());

        return response()->json($inventario);
    }

    /**
     * Elimina un elemento de la base de datos.
     * --- AÑADIDO: Toda esta función para eliminar ---
     */
    public function destroy(ElementoInventario $inventario)
    {
        $inventario->delete();

        // Devolvemos una respuesta vacía con código 204 (No Content)
        // que es el estándar para una eliminación exitosa.
        return response()->noContent();
    }
}