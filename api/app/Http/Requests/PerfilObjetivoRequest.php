<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PerfilObjetivoRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'nombre_perfil' => ['required'],
            'descripcion' => ['nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
