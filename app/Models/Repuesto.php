<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Repuesto extends Model
{
    protected $fillable = [
        'orden_id',
        'nombre_pieza',
        'motivo',
        'estado_pedido',
    ];

    public function orden()
    {
        return $this->belongsTo(Orden::class);
    }
}
