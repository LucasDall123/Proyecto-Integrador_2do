<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    protected $fillable = [
        'equipo_id',
        'usuario_id',
        'codigo',
        'falla_reportada',
        'diagnostico_tecnico',
        'estado',
        'fecha_ingreso',
        'fecha_entrega',
    ];

    protected $casts = [
        'fecha_ingreso' => 'date',
        'fecha_entrega' => 'date',
    ];

    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function repuestos()
    {
        return $this->hasMany(Repuesto::class);
    }
}
