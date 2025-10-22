<?php

namespace Database\Seeders;

use App\Models\Hito;
use Illuminate\Database\Seeder;
use Spatie\SimpleExcel\SimpleExcelReader;

class HitoSeeder extends Seeder
{
    public function run(): void
    {
        $rows = SimpleExcelReader::
        create(database_path('./csv/hitos.csv'))->getRows();

        $rows->each(function (array $row) {
            Hito::factory()->create([
                'nombre_hito' => $row['nombre_hito'],
                'descripcion' => $row['descripcion'],
                'tipo' => $row['tipo'],
                'dificultad' => $row['dificultad'],
                'horas_estimadas' => $row['horas_estimadas'],
            ]);
        });
    }
}
