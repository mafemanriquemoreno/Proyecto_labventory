<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@labventory.com',
        ]);

        $this->call([
            LaboratorioSeeder::class,
            CategoriaSeeder::class,
            ProveedorSeeder::class,
            // --- AÑADIDO: Nuestro nuevo seeder para el inventario ---
            ElementoInventarioSeeder::class,
        ]);
    }
}