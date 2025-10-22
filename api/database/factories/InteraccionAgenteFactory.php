<?php

namespace Database\Factories;

use App\Models\InteraccionAgente;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class InteraccionAgenteFactory extends Factory
{
    protected $model = InteraccionAgente::class;

    public function definition()
    {
        return [
            'fecha_hora' => Carbon::now(),
            'intencion' => $this->faker->word(),
            'tono_agente' => $this->faker->word(),
            'canal' => $this->faker->word(),
            'duracion_segundos' => $this->faker->randomNumber(),
            'sastifaccion_usuario' => $this->faker->randomNumber(),
            'texto_resumen' => $this->faker->word(),

            'id_usuario' => Usuario::factory(),
        ];
    }
}
