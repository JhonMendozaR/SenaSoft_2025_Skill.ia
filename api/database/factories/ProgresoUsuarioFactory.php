<?php

namespace Database\Factories;

use App\Models\ProgresoUsuario;
use App\Models\RoadmapHito;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProgresoUsuarioFactory extends Factory
{
    protected $model = ProgresoUsuario::class;

    public function definition()
    {
        return [
            'estado' => $this->faker->word(),
            'porcentaje_avance' => $this->faker->randomNumber(),
            'fecha_inicio' => Carbon::now(),
            'fecha_fin' => Carbon::now(),

            'id_roadmap_hito' => RoadmapHito::factory(),
        ];
    }
}
