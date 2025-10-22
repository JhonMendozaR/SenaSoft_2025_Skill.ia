<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EvaluacionRequest extends FormRequest
{
    public function rules()
    {
        return [
            'id_usuario' => ['required', 'exists:usuarios'],
            'tipo_evaluacion' => ['required'],
            'modalidad' => ['required'],
            'fecha_evaluacion' => ['required', 'date'],
            'duracion_minutos' => ['required', 'integer'],
            'origen' => ['required'],
            'puntaje_global' => ['required', 'date'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
