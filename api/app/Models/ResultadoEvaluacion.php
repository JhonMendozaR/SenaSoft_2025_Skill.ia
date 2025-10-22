<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultadoEvaluacion extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'resultados_evaluacion';

    protected $fillable = [
        'id_evaluacion',
        'id_competencia',
        'nivel',
        'puntaje',
        'brecha',
    ];

    public function idEvaluacion()
    {
        return $this->belongsTo(Evaluacion::class, 'id_evaluacion');
    }

    public function idCompetencia()
    {
        return $this->belongsTo(Competencia::class, 'id_competencia');
    }
}
