<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuarioViajeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario_viaje', function (Blueprint $table) {
            $table->integer('idUsuario')->unsigned();
            $table->foreign('idUsuario')->references('id')->on('viajes');
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
        Schema::dropIfExists('usuario_viaje');
    }
}
