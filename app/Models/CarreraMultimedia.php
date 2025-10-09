<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarreraMultimedia extends Model
{
    protected $table = 'carrera_multimedia';

    protected $fillable = [
        'carrera_id',
        'tipo',   // 'imagen' o 'video'
        'ruta',
        'orden',
    ];

    // Relación inversa: pertenece a una carrera
    public function carrera()
    {
        return $this->belongsTo(Carrera::class);
    }
}
