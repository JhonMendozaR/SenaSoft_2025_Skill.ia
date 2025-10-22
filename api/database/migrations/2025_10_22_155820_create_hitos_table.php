<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('hitos', function (Blueprint $table) {
            $table->unsignedInteger('id_hito')->autoIncrement();
            $table->string('nombre_hito', 150)->unique();
            $table->string('descripcion', 255)->nullable();
            $table->string('tipo', 20);
            $table->string('dificultad', 10);
            $table->integer('horas_estimadas');

            $table->index(['tipo', 'dificultad'], 'idx_hitos_tipo');
        });
    }

    public function down()
    {
        Schema::dropIfExists('hitos');
    }
};
