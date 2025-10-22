<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            PerfilObjetivoSeeder::class,
            UsuarioSeeder::class,
            CompetenciaSeeder::class,
            EvaluacionSeeder::class,
            ResultadosEvaluacionSeeder::class,
            RoadmapSeeder::class,
            HitoSeeder::class,
            RoadmapsHitoSeeder::class,
            ProgresoUsuarioSeeder::class,
            InteraccionesAgenteSeeder::class,
            RecomendacionSeeder::class,
        ]);
    }
}
