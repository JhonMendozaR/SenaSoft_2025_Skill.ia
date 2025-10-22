<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgresoUsuario extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'progreso_usuario';

    protected $fillable = [
        'id_roadmap_hito',
        'estado',
        'porcentaje_avance',
        'fecha_inicio',
        'fecha_fin',
    ];

    public function idRoadmapHito()
    {
        return $this->belongsTo(RoadmapHito::class, 'id_roadmap_hito');
    }

    protected function casts()
    {
        return [
            'fecha_inicio' => 'timestamp',
            'fecha_fin' => 'timestamp',
        ];
    }
}
