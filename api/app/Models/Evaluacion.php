<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'evaluaciones';

    protected $fillable = [
        'id_usuario',
        'tipo_evaluacion',
        'modalidad',
        'fecha_evaluacion',
        'duracion_minutos',
        'origen',
        'puntaje_global',
    ];

    public function idUsuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    protected function casts()
    {
        return [
            'fecha_evaluacion' => 'timestamp',
        ];
    }
}
