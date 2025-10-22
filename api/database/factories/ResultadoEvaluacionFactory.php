<?php

namespace Database\Factories;

use App\Models\Competencia;
use App\Models\Evaluacion;
use App\Models\ResultadoEvaluacion;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResultadoEvaluacionFactory extends Factory
{
    protected $model = ResultadoEvaluacion::class;

    public function definition()
    {
        return [
            'nivel' => $this->faker->randomNumber(),
            'puntaje' => $this->faker->randomFloat(),
            'brecha' => $this->faker->word(),

            'id_evaluacion' => Evaluacion::factory(),
            'id_competencia' => Competencia::factory(),
        ];
    }
}
