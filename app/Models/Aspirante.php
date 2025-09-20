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
        'fecha_nacimiento',
        'escuela_procedencia',
        'telefono',
        'email',
        'password',
        'status',
        'accepted_terms',
        'carrera_principal_id', // 👈 AGREGA ESTO
    ];

    protected $hidden = [
        'password',
    ];

    // Relación: un aspirante puede elegir varias carreras
    public function carreras()
    {
        return $this->belongsToMany(Carrera::class, 'aspirante_carrera')->withTimestamps();
    }

    // Relación: carrera principal
    public function carreraPrincipal()
    {
        return $this->belongsTo(Carrera::class, 'carrera_principal_id');
    }

    // Mutator: encripta la contraseña automáticamente
    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['password'] = bcrypt($value);
        }
    }
}
