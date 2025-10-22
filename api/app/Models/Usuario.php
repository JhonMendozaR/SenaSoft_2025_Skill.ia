<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    public $timestamps = false;

    protected $table = 'usuarios';

    protected $primaryKey = 'id_usuario';

    protected $keyType = 'int';

    protected $fillable = [
        'nombres',
        'apellidos',
        'cedula',
        'telefono',
        'email',
        'contrasena_hash',
        'departamento',
        'ciudad',
        'barrio',
        'direccion',
        'experiencia_anos',
        'sector',
        'aspiracion',
        'nivel_ingles_autoreporte',
        'seniority_autoreporte',
        'regimen_vinculacion',
        'perfil_objetivo_id',
        'fecha_registro'
    ];

    protected $hidden = [
        'contrasena_hash',
    ];

    protected function casts(): array
    {
        return [
            'contrasena_hash' => 'hashed',
        ];
    }
}
