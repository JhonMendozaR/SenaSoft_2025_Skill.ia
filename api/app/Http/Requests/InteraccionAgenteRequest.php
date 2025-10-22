<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InteraccionAgenteRequest extends FormRequest
{
    public function rules()
    {
        return [
            'id_usuario' => ['required', 'exists:usuarios'],
            'fecha_hora' => ['required', 'date'],
            'intencion' => ['required'],
            'tono_agente' => ['required'],
            'canal' => ['required'],
            'duracion_segundos' => ['required', 'integer'],
            'sastifaccion_usuario' => ['nullable', 'integer'],
            'texto_resumen' => ['nullable'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
