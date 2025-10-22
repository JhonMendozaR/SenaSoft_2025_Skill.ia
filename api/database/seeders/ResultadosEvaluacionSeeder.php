<?php

namespace Database\Seeders;

use App\Models\ResultadoEvaluacion;
use Illuminate\Database\Seeder;
use Spatie\SimpleExcel\SimpleExcelReader;

class ResultadosEvaluacionSeeder extends Seeder
{
    public function run(): void
    {
        $rows = SimpleExcelReader::
        create(database_path('./csv/resultados_evaluacion.csv'))->getRows();

        $rows->each(function (array $row) {
            ResultadoEvaluacion::factory()->create([
                'id_evaluacion' => $row['id_evaluacion'],
                'id_competencia' => $row['id_competencia'],
                'nivel' => $row['nivel'],
                'puntaje' => $row['puntaje'],
                'brecha' => $row['brecha'],
            ]);
        });
    }
}
