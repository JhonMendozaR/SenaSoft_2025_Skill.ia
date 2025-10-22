<?php

namespace App\Http\Resources;

use App\Models\Competencia;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Competencia */
class CompetenciaResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id_competencia' => $this->id_competencia,
            'nombre_competencia' => $this->nombre_competencia,
            'tipo' => $this->tipo,
            'descripcion' => $this->descripcion,
        ];
    }
}
