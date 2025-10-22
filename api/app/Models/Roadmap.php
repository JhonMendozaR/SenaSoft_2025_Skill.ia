<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roadmap extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id_usuario',
        'id_perfil_objetivo',
        'estado',
        'fecha_creacion',
    ];

    public function idUsuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function idPerfilObjetivo()
    {
        return $this->belongsTo(PerfilObjetivo::class, 'id_perfil_objetivo');
    }

    protected function casts()
    {
        return [
            'fecha_creacion' => 'timestamp',
        ];
    }
}
