<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialContacto extends Model
{
    use HasFactory;

    protected $fillable = [
        'aspirante_id',
        'tipo',
        'mensaje',
    ];

    public function aspirante()
    {
        return $this->belongsTo(Aspirante::class);
    }
}
