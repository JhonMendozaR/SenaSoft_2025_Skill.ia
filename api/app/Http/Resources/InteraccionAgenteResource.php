<?php

namespace App\Http\Resources;

use App\Models\InteraccionAgente;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin InteraccionAgente */
class InteraccionAgenteResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id_interaccion' => $this->id_interaccion,
            'fecha_hora' => $this->fecha_hora,
            'intencion' => $this->intencion,
            'tono_agente' => $this->tono_agente,
            'canal' => $this->canal,
            'duracion_segundos' => $this->duracion_segundos,
            'sastifaccion_usuario' => $this->sastifaccion_usuario,
            'texto_resumen' => $this->texto_resumen,

            'id_usuario' => $this->id_usuario,
        ];
    }
}
