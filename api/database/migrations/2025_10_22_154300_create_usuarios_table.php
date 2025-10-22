<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            /* COLUMNAS */
            $table->unsignedInteger('id_usuario')->autoIncrement();
            $table->string('nombres', 120);
            $table->string('apellidos', 120);
            $table->string('cedula', 15)->unique();
            $table->string('telefono', 20);
            $table->string('email', 150)->unique();
            $table->string('contrasena_hash', 255);
            $table->string('departamento', 80);
            $table->string('ciudad', 80);
            $table->string('barrio', 80);
            $table->string('direccion', 120);
            $table->integer('experiencia_anos')->default(0);
            $table->string('sector', 60)->nullable();
            $table->string('aspiracion', 80)->nullable();
            $table->string('nivel_ingles_autoreporte', 5)->nullable();
            $table->string('seniority_autoreporte', 20)->nullable();
            $table->string('regimen_vinculacion', 20)->nullable();

            /* LLAVES FORANEAS */
            $table->unsignedInteger('perfil_objetivo_id');
            $table->foreign('perfil_objetivo_id')->references('id_perfil')->on('perfiles_objetivo');

            $table->timestamp('fecha_registro');

            /* INDICES */
            $table->index('email', 'idx_usuarios_email');
            $table->index('ciudad', 'idx_usuarios_ciudad');
            $table->index('perfil_objetivo_id', 'idx_usuarios_perfil');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
