<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('interacciones_agente', function (Blueprint $table) {
            $table->unsignedInteger('id_interaccion')->autoIncrement();

            /* LLAVES FORANEAS */
            $table->unsignedInteger('id_usuario');
            $table->foreign('id_usuario')->references('id_usuario')->on('usuarios');

            $table->timestamp('fecha_hora');
            $table->string('intencion', 30);
            $table->string('tono_agente', 20);
            $table->string('canal', 20);
            $table->integer('duracion_segundos');
            $table->integer('sastifaccion_usuario')->nullable();
            $table->string('texto_resumen')->nullable();

            $table->index(['id_usuario', 'fecha_hora'], 'idx_int_usuario');
        });
    }

    public function down()
    {
        Schema::dropIfExists('interacciones_agente');
    }
};
