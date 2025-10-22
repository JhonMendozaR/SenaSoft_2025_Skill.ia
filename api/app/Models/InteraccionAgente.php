<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InteraccionAgente extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'interacciones_agente';

    protected $fillable = [
        'id_usuario',
        'fecha_hora',
        'intencion',
        'tono_agente',
        'canal',
        'duracion_segundos',
        'sastifaccion_usuario',
        'texto_resumen',
    ];

    public function idUsuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    protected function casts()
    {
        return [
            'fecha_hora' => 'timestamp',
        ];
    }
}
