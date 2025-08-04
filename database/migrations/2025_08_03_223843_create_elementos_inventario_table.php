<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("CREATE TYPE tipo_presentacion AS ENUM ('Ampolla', 'Frasco', 'Kit', 'Bolsa', 'Casete', 'Gradilla', 'Caja', 'Tubos', 'Unidades', 'Otro')");
        DB::statement("CREATE TYPE tipo_elemento_inventario AS ENUM ('Reactivo', 'Dispositivo médico', 'Insumo', 'Otro')");

        Schema::create('elementos_inventario', function (Blueprint $table) {
            $table->id();
            $table->text('nombre_elemento');
            $table->string('lote', 50)->nullable();
            $table->string('presentacion')->nullable();
            $table->string('marca', 50)->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->string('tipo_elemento')->nullable();
            $table->integer('existencias_elemento')->default(0);
            $table->foreignId('laboratorio_id')->constrained('laboratorio')->onDelete('cascade');
            $table->foreignId('proveedor_id')->nullable()->constrained('proveedores')->onDelete('set null');
            $table->foreignId('categoria_id')->nullable()->constrained('categorias')->onDelete('set null');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE elementos_inventario ALTER COLUMN presentacion TYPE tipo_presentacion USING (presentacion::tipo_presentacion)");
        DB::statement("ALTER TABLE elementos_inventario ALTER COLUMN tipo_elemento TYPE tipo_elemento_inventario USING (tipo_elemento::tipo_elemento_inventario)");
    }

    public function down(): void
    {
        Schema::dropIfExists('elementos_inventario');
        DB::statement('DROP TYPE IF EXISTS tipo_presentacion');
        DB::statement('DROP TYPE IF EXISTS tipo_elemento_inventario');
    }
};