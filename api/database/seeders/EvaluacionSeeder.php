<?php

namespace Database\Seeders;

use App\Models\Evaluacion;
use Illuminate\Database\Seeder;
use Spatie\SimpleExcel\SimpleExcelReader;

class EvaluacionSeeder extends Seeder
{
    public function run(): void
    {
        $rows = SimpleExcelReader::
        create(database_path('./csv/evaluaciones.csv'))->getRows();

        $rows->each(function (array $row) {
            Evaluacion::factory()->create([
                'id_usuario' => $row['id_usuario'],
                'tipo_evaluacion' => $row['tipo_evaluacion'],
                'modalidad' => $row['modalidad'],
                'fecha_evaluacion' => $row['fecha_evaluacion'],
                'duracion_minutos' => $row['duracion_minutos'],
                'origen' => $row['origen'],
                'puntaje_global' => $row['puntaje_global'],
            ]);
        });
    }
}
