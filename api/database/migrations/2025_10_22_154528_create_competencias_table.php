<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('competencias', function (Blueprint $table) {
            $table->unsignedInteger('id_competencia')->autoIncrement();
            $table->string('nombre_competencia', 120)->unique();
            $table->string('tipo', 20);
            $table->string('descripcion', 255)->nullable();

            $table->index('tipo', 'idx_competencias_tipo');
        });
    }

    public function down()
    {
        Schema::dropIfExists('competencias');
    }
};
