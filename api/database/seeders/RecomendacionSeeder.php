<?php

namespace Database\Seeders;

use App\Models\Recomendacion;
use Illuminate\Database\Seeder;
use Spatie\SimpleExcel\SimpleExcelReader;

class RecomendacionSeeder extends Seeder
{
    public function run(): void
    {
        $rows = SimpleExcelReader::
        create(database_path('./csv/recomendaciones.csv'))->getRows();

        $rows->each(function (array $row) {
            Recomendacion::factory()->create([
                'id_usuario' => $row['id_usuario'],
                'fecha_hora' => $row['fecha_hora'],
                'categoria' => $row['categoria'],
                'detalle' => $row['detalle'],
                'justificacion' => $row['justificacion'],
            ]);
        });
    }
}
