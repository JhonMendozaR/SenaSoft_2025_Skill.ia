<?php

namespace Database\Seeders;

use App\Models\PerfilObjetivo;
use Illuminate\Database\Seeder;
use Spatie\SimpleExcel\SimpleExcelReader;

class PerfilObjetivoSeeder extends Seeder
{
    public function run(): void
    {
        $rows = SimpleExcelReader::
            create(database_path('./csv/perfiles_objetivo.csv'))->getRows();

        $rows->each(function (array $row) {
            PerfilObjetivo::factory()->create([
                'nombre_perfil' => $row['nombre_perfil'],
                'descripcion' => $row['descripcion'],
            ]);
        });
    }
}
