<?php

namespace Database\Seeders;

use App\Models\Laboratorio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LaboratorioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Laboratorio::create([
            'nombre_lab' => 'Laboratorio Principal',
            'direccion_lab' => 'Avenida Siempre Viva 742',
            'correo_lab' => 'contacto@labprincipal.com',
            'tipo_lab' => 'Clínico',
            'nivel_bioseguridad_lab' => 'BSL-2',
        ]);
    }
}