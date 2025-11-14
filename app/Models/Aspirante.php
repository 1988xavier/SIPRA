<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aspirante extends Model
{
    use HasFactory;

    protected $table = 'aspirantes';

    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'telefono',
        'email',
        'escuela_procedencia',
        'status',
        'accepted_terms',
        'carrera_principal_id',
          'ciclo_id', // ← ← ← AQUI ESTABA EL PROBLEMA
    ];

    // Relación: carrera principal elegida
    public function carreraPrincipal()
    {
        return $this->belongsTo(Carrera::class, 'carrera_principal_id');
    }

    // (Opcional) Relación si después quieres varias carreras
    public function carreras()
    {
        return $this->belongsToMany(Carrera::class, 'aspirante_carrera')->withTimestamps();
    }
}
