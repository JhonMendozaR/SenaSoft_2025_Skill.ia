<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('resultados_evaluacion', function (Blueprint $table) {
            $table->unsignedInteger('id_resultado')->autoIncrement();

            /* LLAVES FORANEAS */
            $table->unsignedInteger('id_evaluacion');
            $table->foreign('id_evaluacion')->references('id_evaluacion')->on('evaluaciones');

            $table->unsignedInteger('id_competencia');
            $table->foreign('id_competencia')->references('id_competencia')->on('competencias');

            $table->integer('nivel');
            $table->decimal('puntaje', 5, 2)->unsigned();
            $table->string('brecha', 15);

            $table->index('id_evaluacion', 'idx_res_eval');
            $table->index('id_competencia', 'idx_res_comp');
        });
    }

    public function down()
    {
        Schema::dropIfExists('resultados_evaluacion');
    }
};
