<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoadmapRequest extends FormRequest
{
    public function rules()
    {
        return [
            'id_usuario' => ['required', 'exists:usuarios'],
            'id_perfil_objetivo' => ['required', 'exists:perfiles_objetivo'],
            'estado' => ['required'],
            'fecha_creacion' => ['required', 'date'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
