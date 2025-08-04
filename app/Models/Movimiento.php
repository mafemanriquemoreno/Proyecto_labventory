<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Movimiento extends Model
{
    use HasFactory;

    protected $table = 'movimientos';

    public function elementoInventario(): BelongsTo
    {
        return $this->belongsTo(ElementoInventario::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}