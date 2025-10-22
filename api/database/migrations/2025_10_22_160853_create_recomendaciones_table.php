<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('recomendaciones', function (Blueprint $table) {
            $table->unsignedInteger('id_recomendacion')->autoIncrement();

            /* LLAVES FORANEAS */
            $table->unsignedInteger('id_usuario');
            $table->foreign('id_usuario')->references('id_usuario')->on('usuarios');

            $table->timestamp('fecha_hora');
            $table->string('categoria', 40);
            $table->string('detalle', 255);
            $table->string('justificacion', 255)->nullable();

            $table->index(['id_usuario', 'fecha_hora'], 'idx_rec_usuario');
        });
    }

    public function down()
    {
        Schema::dropIfExists('recomendaciones');
    }
};
