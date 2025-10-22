<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('roadmap_hitos', function (Blueprint $table) {
            $table->unsignedInteger('id_roadmap_hito')->autoIncrement();

            /* LLAVES FORANEAS */
            $table->unsignedInteger('id_roadmap');
            $table->foreign('id_roadmap')->references('id_roadmap')->on('roadmaps');

            $table->unsignedInteger('id_hito');
            $table->foreign('id_hito')->references('id_hito')->on('hitos');

            $table->integer('orden');

            $table->index(['id_roadmap', 'orden'], 'idx_rmh_roadmap');
            $table->index('id_hito', 'idx_rmh_hito');
        });
    }

    public function down()
    {
        Schema::dropIfExists('roadmap_hitos');
    }
};
