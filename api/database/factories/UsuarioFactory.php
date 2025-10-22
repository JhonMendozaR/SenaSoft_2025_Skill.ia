<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class UsuarioFactory extends Factory
{

    protected static ?string $password_hash;

    public function definition(): array
    {
        $faker = Faker::create('es_ES');
        return [
            'nombres' => $faker->firstName(),
            'apellidos' => $faker->lastName(),
            'cedula' => $faker->randomNumber(8, true),
            'telefono' => $faker->phoneNumber(),
            'email' => $faker->unique()->safeEmail(),
            'contrasena_hash' => bcrypt('password123'),
            'departamento' => $faker->state(),
            'ciudad' => $faker->city(),
            'barrio' => $faker->streetName(),
            'direccion' => $faker->address(),
            'experiencia_anos' => $faker->numberBetween(0, 20),
            'sector' => $faker->word(),
            'aspiracion' => $faker->jobTitle(),
            'nivel_ingles_autoreporte' => $faker->randomElement(['A2', 'B1', 'B2', 'C1']),
            'seniority_autoreporte' => $faker->randomElement(['Junior', 'Semi-Senior', 'Senior']),
            'regimen_vinculacion' => $faker->randomElement(['Empleado', 'Contratista']),
            'perfil_objetivo_id' => $faker->numberBetween(1, 10),
            'fecha_registro' => $faker->dateTimeThisYear(),
        ];
    }
}
