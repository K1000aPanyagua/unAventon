<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('patente');
            $table->string('marca');
            $table->string('modelo');
            $table->string('color');
            $table->integer('nroAsientos');
            $table->integer('idUsuario')->unsigned();
            $table->foreign('idUsuario')->references('id')->on('usuarios');
            $table->string('tipoVehiculo');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehiculos');
    }
}
