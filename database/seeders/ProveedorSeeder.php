<?php

namespace Database\Seeders;

use App\Models\Proveedor;
use Illuminate\Database\Seeder;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpiamos la tabla para evitar duplicados
        Proveedor::truncate();
        
        $proveedores = [
            'ProQuímicos S.A.S', // <-- Añadido para que el otro seeder lo encuentre
            'Abbott', 
            'Roche', 
            'Siemens', 
            'Sysmex'
        ];

        foreach ($proveedores as $proveedor) {
            Proveedor::create(['nombre_proveedor' => $proveedor]);
        }
    }
}
