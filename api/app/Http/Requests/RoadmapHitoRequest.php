<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoadmapHitoRequest extends FormRequest
{
    public function rules()
    {
        return [
            'id_roadmap' => ['required', 'exists:roadmaps'],
            'id_hito' => ['required', 'exists:hitos'],
            'orden' => ['required', 'integer'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
