<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompetenciaRequest extends FormRequest
{
    public function rules()
    {
        return [
            'nombre_competencia' => ['required'],
            'tipo' => ['required'],
            'descripcion' => ['nullable'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
