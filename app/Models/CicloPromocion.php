<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CicloPromocion extends Model
{
    use HasFactory;

    // Nombre real de la tabla
    protected $table = 'ciclos_promocion';

    // Campos que se pueden asignar de forma masiva
    protected $fillable = [
        'anio',
        'fecha_inicio',
        'fecha_cierre',
        'estado',
    ];
}
