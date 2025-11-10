<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventoAspirante extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'fecha',
    ];
}
