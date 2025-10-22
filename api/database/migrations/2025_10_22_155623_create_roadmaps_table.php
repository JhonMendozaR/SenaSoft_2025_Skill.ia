<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('roadmaps', function (Blueprint $table) {
            $table->unsignedInteger('id_roadmap')->autoIncrement();

            /* LLAVES FORANEAS */
            $table->unsignedInteger('id_usuario');
            $table->foreign('id_usuario')->references('id_usuario')->on('usuarios');

            $table->unsignedInteger('id_perfil_objetivo');
            $table->foreign('id_perfil_objetivo')->references('id_perfil')->on('perfiles_objetivo');

            $table->string('estado', 20);
            $table->timestamp('fecha_creacion');

            $table->index('id_usuario', 'idx_roadmap_usuario');
            $table->index('id_perfil_objetivo', 'idx_roadmap_perfil');
        });
    }

    public function down()
    {
        Schema::dropIfExists('roadmaps');
    }
};
