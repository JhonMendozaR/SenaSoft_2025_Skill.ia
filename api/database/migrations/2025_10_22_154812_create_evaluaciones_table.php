<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('evaluaciones', function (Blueprint $table) {
            $table->unsignedInteger('id_evaluacion')->autoIncrement();

            /* LLAVES FORANEAS */
            $table->unsignedInteger('id_usuario');
            $table->foreign('id_usuario')->references('id_usuario')->on('usuarios');

            $table->string('tipo_evaluacion', 30);
            $table->string('modalidad', 20);
            $table->timestamp('fecha_evaluacion');
            $table->integer('duracion_minutos');
            $table->string('origen', 20);
            $table->decimal('puntaje_global', 5, 2)->unsigned();

            $table->index(['id_usuario', 'fecha_evaluacion'], 'idx_eval_usuario');
            $table->index('modalidad', 'idx_eval_modalidad');
        });
    }

    public function down()
    {
        Schema::dropIfExists('evaluaciones');
    }
};
