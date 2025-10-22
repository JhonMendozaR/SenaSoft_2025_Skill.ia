<?php

namespace Database\Factories;

use App\Models\Evaluacion;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class EvaluacionFactory extends Factory
{
    protected $model = Evaluacion::class;

    public function definition()
    {
        return [
            'tipo_evaluacion' => $this->faker->word(),
            'modalidad' => $this->faker->word(),
            'fecha_evaluacion' => Carbon::now(),
            'duracion_minutos' => $this->faker->randomNumber(),
            'origen' => $this->faker->word(),
            'puntaje_global' => Carbon::now(),

            'id_usuario' => Usuario::factory(),
        ];
    }
}
