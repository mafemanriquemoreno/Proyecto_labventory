<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpiamos la tabla para evitar duplicados en cada ejecución
        Categoria::truncate();

        $categorias = [
            'Reactivos PCR', // <-- Añadido para que el otro seeder lo encuentre
            'Hematología', 
            'Química Clínica', 
            'Hormonas', 
            'Parasitología', 
            'Control Calidad', 
            'Material Laboratorio', 
            'Pruebas Rápidas', 
            'Microbiología', 
            'Coagulación'
        ];

        foreach ($categorias as $categoria) {
            Categoria::create(['nombre_categoria' => $categoria]);
        }
    }
}
