<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HitoRequest extends FormRequest
{
    public function rules()
    {
        return [
            'nombre_hito' => ['required'],
            'descripcion' => ['nullable'],
            'tipo' => ['required'],
            'dificultad' => ['required'],
            'horas_estimadas' => ['required', 'integer'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
