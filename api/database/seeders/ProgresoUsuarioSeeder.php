<?php

namespace Database\Seeders;

use App\Models\ProgresoUsuario;
use Illuminate\Database\Seeder;
use Spatie\SimpleExcel\SimpleExcelReader;

class ProgresoUsuarioSeeder extends Seeder
{
    public function run(): void
    {
        $rows = SimpleExcelReader::
        create(database_path('./csv/progreso_usuario.csv'))->getRows();

        $rows->each(function (array $row) {
            ProgresoUsuario::factory()->create([
                'id_roadmap_hito' => $row['id_roadmap_hito'],
                'estado' => $row['estado'],
                'porcentaje_avance' => $row['porcentaje_avance'],
                'fecha_inicio' => $row['fecha_inicio'] ?: now(),
                'fecha_fin' => !empty($row['fecha_fin']) ? $row['fecha_fin'] : null,
            ]);
        });
    }
}
