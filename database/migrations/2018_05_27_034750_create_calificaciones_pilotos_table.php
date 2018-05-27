<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalificacionesPilotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calificaciones_pilotos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('valor');
            $table->integer('idPiloto')->unsigned();
            $table->foreign('idPiloto')->references('id')->on('usuarios');
             $table->integer('idCopiloto')->unsigned();
            $table->foreign('idCopiloto')->references('id')->on('usuarios');
            $table->string('reseña');
            $table->integer('idViaje')->unsigned();
            $table->foreign('idViaje')->references('id')->on('viajes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calificaciones_pilotos');
    }
}
