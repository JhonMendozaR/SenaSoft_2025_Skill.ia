<?php

namespace App\Http\Resources;

use App\Models\Recomendacion;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Recomendacion */
class RecomendacionResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id_recomendacion' => $this->id_recomendacion,
            'fecha_hora' => $this->fecha_hora,
            'categoria' => $this->categoria,
            'detalle' => $this->detalle,
            'justificacion' => $this->justificacion,

            'id_usuario' => $this->id_usuario,
        ];
    }
}
