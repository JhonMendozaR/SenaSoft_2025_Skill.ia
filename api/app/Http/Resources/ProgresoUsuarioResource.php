<?php

namespace App\Http\Resources;

use App\Models\ProgresoUsuario;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin ProgresoUsuario */
class ProgresoUsuarioResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id_avance' => $this->id_avance,
            'estado' => $this->estado,
            'porcentaje_avance' => $this->porcentaje_avance,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,

            'id_roadmap_hito' => $this->id_roadmap_hito,

            'idRoadmapHito' => new RoadmapHitoResource($this->whenLoaded('idRoadmapHito')),
        ];
    }
}
