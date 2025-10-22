<?php

namespace Database\Seeders;

use App\Models\Roadmap;
use Illuminate\Database\Seeder;
use Spatie\SimpleExcel\SimpleExcelReader;

class RoadmapSeeder extends Seeder
{
    public function run(): void
    {
        $rows = SimpleExcelReader::
        create(database_path('./csv/roadmaps.csv'))->getRows();

        $rows->each(function (array $row) {
            Roadmap::factory()->create([
                'id_usuario' => $row['id_usuario'],
                'id_perfil_objetivo' => $row['id_perfil_objetivo'],
                'estado' => $row['estado'],
                'fecha_creacion' => $row['fecha_creacion'],
            ]);
        });
    }
}
