<?php

namespace App\Http\Resources;

use App\Models\Hito;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Hito */
class HitoResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id_hito' => $this->id_hito,
            'nombre_hito' => $this->nombre_hito,
            'descripcion' => $this->descripcion,
            'tipo' => $this->tipo,
            'dificultad' => $this->dificultad,
            'horas_estimadas' => $this->horas_estimadas,
        ];
    }
}
