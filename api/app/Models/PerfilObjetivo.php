<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PerfilObjetivo extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'perfiles_objetivo';

    protected $fillable = [
        'nombre_perfil',
        'descripcion',
    ];
}
