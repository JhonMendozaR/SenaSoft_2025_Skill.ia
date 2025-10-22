<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('progreso_usuario', function (Blueprint $table) {
            $table->unsignedInteger('id_avance')->autoIncrement();

            /* LLAVES FORANEAS */
            $table->unsignedInteger('id_roadmap_hito');
            $table->foreign('id_roadmap_hito')->references('id_roadmap_hito')->on('roadmap_hitos');

            $table->string('estado', 20);
            $table->integer('porcentaje_avance');
            $table->timestamp('fecha_inicio')->nullable();
            $table->timestamp('fecha_fin')->nullable();

            $table->index('id_roadmap_hito', 'idx_prog_rmh');
        });
    }

    public function down()
    {
        Schema::dropIfExists('progreso_usuario');
    }
};
