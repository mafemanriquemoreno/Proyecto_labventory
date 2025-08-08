<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // --- AÑADIDO: Bloque de Autolimpieza ---
        // Este bloque se asegura de que todos los tipos ENUM personalizados se eliminen
        // antes de intentar crearlos. Esto previene el error de "objeto duplicado".
        DB::statement('DROP TYPE IF EXISTS tipo_movimiento_inventario CASCADE');
        DB::statement('DROP TYPE IF EXISTS tipo_elemento_inventario CASCADE');
        DB::statement('DROP TYPE IF EXISTS tipo_presentacion CASCADE');
        DB::statement('DROP TYPE IF EXISTS nivel_bioseguridad CASCADE');
        DB::statement('DROP TYPE IF EXISTS tipo_laboratorio CASCADE');


        // --- El resto del código continúa como antes ---
        DB::statement("CREATE TYPE tipo_laboratorio AS ENUM ('Química', 'Microbiología', 'Biología Molecular', 'Veterinaria', 'Investigación', 'Clínico', 'Otro')");
        DB::statement("CREATE TYPE nivel_bioseguridad AS ENUM ('BSL-1', 'BSL-2', 'BSL-3', 'BSL-4')");

        Schema::create('laboratorio', function (Blueprint $table) {
            $table->id();
            $table->text('nombre_lab');
            $table->text('direccion_lab')->nullable();
            $table->text('correo_lab')->unique()->nullable();
            $table->string('telefono_lab', 20)->nullable();
            $table->string('tipo_lab')->nullable();
            $table->string('nivel_bioseguridad_lab')->nullable();
            $table->timestamps();
        });

        DB::statement("ALTER TABLE laboratorio ALTER COLUMN tipo_lab TYPE tipo_laboratorio USING (tipo_lab::tipo_laboratorio)");
        DB::statement("ALTER TABLE laboratorio ALTER COLUMN nivel_bioseguridad_lab TYPE nivel_bioseguridad USING (nivel_bioseguridad_lab::nivel_bioseguridad)");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laboratorio');
        DB::statement('DROP TYPE IF EXISTS tipo_laboratorio');
        DB::statement('DROP TYPE IF EXISTS nivel_bioseguridad');
    }
};
