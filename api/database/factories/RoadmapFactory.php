<?php

namespace Database\Factories;

use App\Models\PerfilObjetivo;
use App\Models\Roadmap;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class RoadmapFactory extends Factory
{
    protected $model = Roadmap::class;

    public function definition()
    {
        return [
            'estado' => $this->faker->word(),
            'fecha_creacion' => Carbon::now(),

            'id_usuario' => Usuario::factory(),
            'id_perfil_objetivo' => PerfilObjetivo::factory(),
        ];
    }
}
