<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'nombres',
        'dni',
        'telefono',
        'email',
    ];


    public function equipos()
    {
        return $this->hasMany(Equipo::class);
    }
}
