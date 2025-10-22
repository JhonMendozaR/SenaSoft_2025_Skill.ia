<?php

namespace Database\Factories;

use App\Models\Recomendacion;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class RecomendacionFactory extends Factory
{
    protected $model = Recomendacion::class;

    public function definition()
    {
        return [
            'fecha_hora' => Carbon::now(),
            'categoria' => $this->faker->word(),
            'detalle' => $this->faker->word(),
            'justificacion' => $this->faker->word(),

            'id_usuario' => Usuario::factory(),
        ];
    }
}
