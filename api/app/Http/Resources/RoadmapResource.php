<?php

namespace App\Http\Resources;

use App\Models\Roadmap;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Roadmap */
class RoadmapResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id_roadmap' => $this->id_roadmap,
            'estado' => $this->estado,
            'fecha_creacion' => $this->fecha_creacion,

            'id_usuario' => $this->id_usuario,
            'id_perfil_objetivo' => $this->id_perfil_objetivo,

            'idPerfilObjetivo' => new PerfilObjetivoResource($this->whenLoaded('idPerfilObjetivo')),
        ];
    }
}
