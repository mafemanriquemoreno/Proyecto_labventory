<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("CREATE TYPE tipo_movimiento_inventario AS ENUM ('entrada', 'salida')");

        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad');
            $table->string('tipo_movimiento');
            $table->text('descripcion')->nullable();
            $table->foreignId('elemento_inventario_id')->constrained('elementos_inventario')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestampTz('fecha_movimiento')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        DB::statement("ALTER TABLE movimientos ALTER COLUMN tipo_movimiento TYPE tipo_movimiento_inventario USING (tipo_movimiento::tipo_movimiento_inventario)");
    }

    public function down(): void
    {
        Schema::dropIfExists('movimientos');
        DB::statement('DROP TYPE IF EXISTS tipo_movimiento_inventario');
    }
};