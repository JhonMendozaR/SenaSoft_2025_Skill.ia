<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProgresoUsuarioRequest extends FormRequest
{
    public function rules()
    {
        return [
            'id_roadmap_hito' => ['required', 'exists:roadmap_hitos'],
            'estado' => ['required'],
            'porcentaje_avance' => ['required', 'integer'],
            'fecha_inicio' => ['nullable', 'date'],
            'fecha_fin' => ['nullable', 'date'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
