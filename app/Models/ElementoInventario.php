<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ElementoInventario extends Model
{
    use HasFactory;

    protected $table = 'elementos_inventario';

    /**
     * The attributes that are mass assignable.
     * --- AÑADIDO: Esta propiedad le dice a Laravel qué campos podemos guardar masivamente ---
     * @var array
     */
    protected $fillable = [
        'nombre_elemento',
        'lote',
        'presentacion',
        'marca',
        'fecha_vencimiento',
        'tipo_elemento',
        'existencias_elemento',
        'laboratorio_id',
        'proveedor_id',
        'categoria_id',
    ];


    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    public function proveedor(): BelongsTo
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function laboratorio(): BelongsTo
    {
        return $this->belongsTo(Laboratorio::class);
    }

    public function movimientos(): HasMany
    {
        return $this->hasMany(Movimiento::class);
    }
}