<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('perfiles_objetivo', function (Blueprint $table) {
            $table->unsignedInteger('id_perfil')->autoIncrement();
            $table->string('nombre_perfil', 120)->unique();
            $table->string('descripcion', 255)->nullable();

            $table->index('nombre_perfil', 'idx_perfiles_nombre');
        });
    }

    public function down()
    {
        Schema::dropIfExists('perfiles_objetivo');
    }
};
