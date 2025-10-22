<?php

namespace Database\Factories;

use App\Models\Competencia;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompetenciaFactory extends Factory
{
    protected $model = Competencia::class;

    public function definition()
    {
        return [
            'nombre_competencia' => $this->faker->word(),
            'tipo' => $this->faker->word(),
            'descripcion' => $this->faker->word(),
        ];
    }
}
