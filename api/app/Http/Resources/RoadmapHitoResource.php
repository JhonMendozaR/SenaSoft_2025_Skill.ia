<?php

namespace App\Http\Resources;

use App\Models\RoadmapHito;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin RoadmapHito */
class RoadmapHitoResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id_roadmap_hito' => $this->id_roadmap_hito,
            'orden' => $this->orden,

            'id_roadmap' => $this->id_roadmap,
            'id_hito' => $this->id_hito,

            'idRoadmap' => new RoadmapResource($this->whenLoaded('idRoadmap')),
            'idHito' => new HitoResource($this->whenLoaded('idHito')),
        ];
    }
}
