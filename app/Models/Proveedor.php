<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedores';

    /**
     * Define la relación "uno a muchos" con ElementoInventario.
     */
    public function elementosInventario(): HasMany
    {
        return $this->hasMany(ElementoInventario::class);
    }
}