<?php

namespace App\Http\Resources;

use App\Models\Evaluacion;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Evaluacion */
class EvaluacionResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id_evaluacion' => $this->id_evaluacion,
            'tipo_evaluacion' => $this->tipo_evaluacion,
            'modalidad' => $this->modalidad,
            'fecha_evaluacion' => $this->fecha_evaluacion,
            'duracion_minutos' => $this->duracion_minutos,
            'origen' => $this->origen,
            'puntaje_global' => $this->puntaje_global,

            'id_usuario' => $this->id_usuario,
        ];
    }
}
