<?php

namespace Database\Seeders;

use App\Models\RoadmapHito;
use Illuminate\Database\Seeder;
use Spatie\SimpleExcel\SimpleExcelReader;

class RoadmapsHitoSeeder extends Seeder
{
    public function run(): void
    {
        $rows = SimpleExcelReader::
        create(database_path('./csv/roadmap_hitos.csv'))->getRows();

        $rows->each(function (array $row) {
            RoadmapHito::factory()->create([
                'id_roadmap' => $row['id_roadmap'],
                'id_hito' => $row['id_hito'],
                'orden' => $row['orden'],
            ]);
        });
    }
}
