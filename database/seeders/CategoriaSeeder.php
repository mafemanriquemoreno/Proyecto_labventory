<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categoria::create([
            'nombre_categoria' => 'Reactivos PCR',
            'descripcion_categoria' => 'Reactivos utilizados para la Reacción en Cadena de la Polimerasa.',
        ]);

        Categoria::create([
            'nombre_categoria' => 'Medios de Cultivo',
            'descripcion_categoria' => 'Sustratos para el crecimiento de microorganismos.',
        ]);
    }
}