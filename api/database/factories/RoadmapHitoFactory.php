<?php

namespace Database\Factories;

use App\Models\Hito;
use App\Models\Roadmap;
use App\Models\RoadmapHito;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoadmapHitoFactory extends Factory
{
    protected $model = RoadmapHito::class;

    public function definition()
    {
        return [
            'orden' => $this->faker->randomNumber(),

            'id_roadmap' => Roadmap::factory(),
            'id_hito' => Hito::factory(),
        ];
    }
}
