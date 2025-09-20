<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Carrera extends Model
{
    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
        'objetivo',
        'perfil',
        'plan_estudio',
        'desarrollo_profesional',
        'competencias',
        'requisitos',
        'capacidad',
        'imagen',
        'video',
        'vistas',
        'activo',
    ];

    // Generar slug automáticamente al guardar
    protected static function booted()
    {
        static::creating(function ($carrera) {
            if (empty($carrera->slug)) {
                $carrera->slug = Str::slug($carrera->nombre, '-');
            }
        });

        static::updating(function ($carrera) {
            if (empty($carrera->slug)) {
                $carrera->slug = Str::slug($carrera->nombre, '-');
            }
        });
    }
}
