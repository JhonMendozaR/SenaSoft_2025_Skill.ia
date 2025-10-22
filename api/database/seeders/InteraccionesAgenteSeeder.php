<?php

namespace Database\Seeders;

use App\Models\InteraccionAgente;
use Illuminate\Database\Seeder;
use Spatie\SimpleExcel\SimpleExcelReader;

class InteraccionesAgenteSeeder extends Seeder
{
    public function run(): void
    {
        $rows = SimpleExcelReader::
        create(database_path('./csv/interacciones_agente.csv'))->getRows();

        $rows->each(function (array $row) {
            InteraccionAgente::factory()->create([
                'id_usuario' => $row['id_usuario'],
                'fecha_hora' => $row['fecha_hora'],
                'intencion' => $row['intencion'],
                'tono_agente' => $row['tono_agente'],
                'canal' => $row['canal'],
                'duracion_segundos' => $row['duracion_segundos'],
                'sastifaccion_usuario' => $row['satisfaccion_usuario'],
                'texto_resumen' => $row['texto_resumen'],
            ]);
        });
    }
}
