<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recomendacion extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'recomendaciones';

    protected $fillable = [
        'id_usuario',
        'fecha_hora',
        'categoria',
        'detalle',
        'justificacion',
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
