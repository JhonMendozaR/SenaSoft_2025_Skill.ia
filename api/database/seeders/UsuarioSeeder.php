<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Spatie\SimpleExcel\SimpleExcelReader;
use Faker\Factory as Faker;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('es_ES');

        $rows = SimpleExcelReader::
            create(database_path('./csv/usuarios.csv'))->getRows();

        $rows->each(function (array $row) use ($faker) {
            $email = $row['email'] ?? null;

            if (empty($email) || Usuario::where('email', $email)->exists()) {
                $email = $faker->unique()->safeEmail();
            }

            Usuario::factory()->state([
                'nombres' => $row['nombres'],
                'apellidos' => $row['apellidos'],
                'cedula' => $row['cedula'],
                'telefono' => $row['telefono'],
                'email' => $email,
                'contrasena_hash' => bcrypt('password'),
                'departamento' => $row['departamento'],
                'ciudad' => $row['ciudad'],
                'barrio' => $row['barrio'],
                'direccion' => $row['direccion'],
                'experiencia_anos' => $row['experiencia_anos'],
                'sector' => $row['sector'],
                'aspiracion' => $row['aspiracion'],
                'nivel_ingles_autoreporte' => $row['nivel_ingles_autoreporte'],
                'seniority_autoreporte' => $row['seniority_autoreporte'],
                'regimen_vinculacion' => $row['regimen_vinculacion'],
                'perfil_objetivo_id' => $row['perfil_objetivo_id'],
                'fecha_registro' => $row['fecha_registro'],
            ])->create();
        });
    }
}
