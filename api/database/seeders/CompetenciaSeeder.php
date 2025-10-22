<?php

namespace Database\Seeders;

use App\Models\Competencia;
use Illuminate\Database\Seeder;
use Spatie\SimpleExcel\SimpleExcelReader;

class CompetenciaSeeder extends Seeder
{
    public function run(): void
    {
        $rows = SimpleExcelReader::
        create(database_path('./csv/competencias.csv'))->getRows();

        $rows->each(function (array $row) {
            Competencia::factory()->create([
                'nombre_competencia' => $row['nombre_competencia'],
                'tipo' => $row['tipo'],
                'descripcion' => $row['descripcion'],
            ]);
        });
    }
}
