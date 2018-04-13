<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConcursoParticipanteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('concurso_participante', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('concurso_id');
            $table->foreign('concurso_id')->references('id')->on('concursos');
            $table->unsignedInteger('participante_id');
            $table->foreign('participante_id')->references('id')->on('participantes');
            $table->integer('puntuacion')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('concurso_participante');
    }
}
