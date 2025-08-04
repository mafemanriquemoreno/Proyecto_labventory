<?php

namespace Database\Seeders;

use App\Models\Proveedor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Proveedor::create([
            'nombre_proveedor' => 'ProQuímicos S.A.S',
            'telefono_proveedor' => '601-555-1234',
            'correo_proveedor' => 'ventas@proquimicos.com',
        ]);

        Proveedor::create([
            'nombre_proveedor' => 'BioSuministros Global',
            'telefono_proveedor' => '604-555-5678',
            'correo_proveedor' => 'pedidos@biosg.com',
        ]);
    }
}