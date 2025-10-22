<?php

namespace Database\Factories;

use App\Models\Hito;
use Illuminate\Database\Eloquent\Factories\Factory;

class HitoFactory extends Factory
{
    protected $model = Hito::class;

    public function definition()
    {
        return [
            'nombre_hito' => $this->faker->word(),
            'descripcion' => $this->faker->word(),
            'tipo' => $this->faker->word(),
            'dificultad' => $this->faker->word(),
            'horas_estimadas' => $this->faker->randomNumber(),
        ];
    }
}
