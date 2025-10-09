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
        'vistas',
        'activo',
    ];

    // Convertir automáticamente 'activo' a boolean
    protected $casts = [
        'activo' => 'boolean',
    ];

    // Relación con aspirantes
    public function aspirantes()
    {
        return $this->hasMany(\App\Models\Aspirante::class, 'carrera_principal_id');
    }

    // Relación con multimedia (tabla separada)
    public function multimedia()
    {
        return $this->hasMany(\App\Models\CarreraMultimedia::class);
    }

    public function imagenes()
    {
        return $this->multimedia()->where('tipo', 'imagen');
    }

    public function videos()
    {
        return $this->multimedia()->where('tipo', 'video');
    }

    // Generar slug automáticamente al crear o actualizar
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
