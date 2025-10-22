<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecomendacionRequest extends FormRequest
{
    public function rules()
    {
        return [
            'id_usuario' => ['required', 'exists:usuarios'],
            'fecha_hora' => ['required', 'date'],
            'categoria' => ['required'],
            'detalle' => ['required'],
            'justificacion' => ['nullable'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
