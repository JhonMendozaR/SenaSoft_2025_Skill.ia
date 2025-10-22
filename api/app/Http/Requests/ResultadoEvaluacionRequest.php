<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResultadoEvaluacionRequest extends FormRequest
{
    public function rules()
    {
        return [
            'id_evaluacion' => ['required', 'exists:evaluaciones'],
            'id_competencia' => ['required', 'exists:competencias'],
            'nivel' => ['required', 'integer'],
            'puntaje' => ['required', 'numeric'],
            'brecha' => ['required'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
