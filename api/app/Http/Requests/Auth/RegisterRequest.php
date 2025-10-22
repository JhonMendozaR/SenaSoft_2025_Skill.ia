<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'nombres' => [
                'required',
                'string',
                'max:100',
            ],
            'apellidos' => [
                'required',
                'string',
                'max:100',
            ],
            'cedula' => [
                'required',
                'numeric',
                'unique:usuarios,cedula',
            ],
            'telefono' => [
                'required',
                'string',
                'max:15',
                'unique:usuarios,telefono',
            ],
            'email' => [
                'required',
                'email',
                'unique:usuarios,email',
            ],
            'contrasena_hash' => [
                'required',
                'string',
                'min:6',
            ],
            'departamento' => [
                'nullable',
                'string',
                'max:100',
            ],
            'ciudad' => [
                'nullable',
                'string',
                'max:100',
            ],
            'barrio' => [
                'nullable',
                'string',
                'max:100',
            ],
            'direccion' => [
                'nullable',
                'string',
                'max:255',
            ],
            'experiencia_anos' => [
                'nullable',
                'integer',
                'min:0',
                'max:50',
            ],
            'sector' => [
                'nullable',
                'string',
                'max:100',
            ],
            'aspiracion' => [
                'nullable',
                'string',
                'max:100',
            ],
            'nivel_ingles_autoreporte' => [
                'nullable',
                'in:A1,A2,B1,B2,C1,C2',
            ],
            'seniority_autoreporte' => [
                'nullable',
                'in:Junior,Semi-Senior,Senior',
            ],
            'regimen_vinculacion' => [
                'nullable',
                'in:Empleado,Contratista',
            ],
            'perfil_objetivo_id' => [
                'nullable',
                'integer',
                'exists:perfiles_objetivo,id',
            ],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
