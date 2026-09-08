<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $fillable = [
        'cliente_id',
        'tipo',
        'marca_modelo',
        'nro_serie_imei',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function ordenes()
    {
        return $this->hasMany(Orden::class);
    }
}
