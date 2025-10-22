<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hito extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'nombre_hito',
        'descripcion',
        'tipo',
        'dificultad',
        'horas_estimadas',
    ];
}
