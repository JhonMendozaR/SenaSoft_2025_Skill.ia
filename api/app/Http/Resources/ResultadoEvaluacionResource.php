<?php

namespace App\Http\Resources;

use App\Models\ResultadoEvaluacion;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin ResultadoEvaluacion */
class ResultadoEvaluacionResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id_resultado' => $this->id_resultado,
            'nivel' => $this->nivel,
            'puntaje' => $this->puntaje,
            'brecha' => $this->brecha,

            'id_evaluacion' => $this->id_evaluacion,
            'id_competencia' => $this->id_competencia,

            'idEvaluacion' => new EvaluacionResource($this->whenLoaded('idEvaluacion')),
            'idCompetencia' => new CompetenciaResource($this->whenLoaded('idCompetencia')),
        ];
    }
}
