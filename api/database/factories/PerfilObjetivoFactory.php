<?php

namespace Database\Factories;

use App\Models\PerfilObjetivo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PerfilObjetivoFactory extends Factory
{
    protected $model = PerfilObjetivo::class;

    public function definition(): array
    {
        return [
            'nombre_perfil' => $this->faker->word(),
            'descripcion' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
