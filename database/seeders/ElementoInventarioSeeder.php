<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// --- AÑADIDO: Importamos los modelos que vamos a usar ---
use App\Models\ElementoInventario;
use App\Models\Laboratorio;
use App\Models\Categoria;
use App\Models\Proveedor;

class ElementoInventarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // --- AÑADIDO: Lógica para crear dos elementos de inventario ---

        // Obtenemos el primer laboratorio, categoría y proveedor que creamos antes
        $laboratorio = Laboratorio::first();
        $categoriaReactivos = Categoria::where('nombre_categoria', 'Reactivos PCR')->first();
        $proveedorProquimicos = Proveedor::where('nombre_proveedor', 'ProQuímicos S.A.S')->first();

        // Creamos el primer elemento
        ElementoInventario::create([
            'nombre_elemento' => 'Kit de Extracción de ARN Viral',
            'lote' => 'ARN-2025-01',
            'presentacion' => 'Kit',
            'marca' => 'BioHealth',
            'fecha_vencimiento' => '2026-12-31',
            'tipo_elemento' => 'Reactivo',
            'existencias_elemento' => 100,
            'laboratorio_id' => $laboratorio->id,
            'proveedor_id' => $proveedorProquimicos->id,
            'categoria_id' => $categoriaReactivos->id,
        ]);

        // Creamos el segundo elemento
        ElementoInventario::create([
            'nombre_elemento' => 'Reactivo de Glucosa',
            'lote' => 'GLU-2025-08',
            'presentacion' => 'Frasco',
            'marca' => 'Roche',
            'fecha_vencimiento' => '2027-08-03',
            'tipo_elemento' => 'Reactivo',
            'existencias_elemento' => 50,
            'laboratorio_id' => $laboratorio->id,
            'proveedor_id' => $proveedorProquimicos->id,
            'categoria_id' => $categoriaReactivos->id,
        ]);
    }
}