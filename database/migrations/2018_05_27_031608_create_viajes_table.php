<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('viajes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idUsuario')->unsigned();
            $table->foreign('idUsuario')->references('id')->on('usuarios');
            $table->integer('idVehiculo')->unsigned();
            $table->foreign('idVehiculo')->references('id')->on('vehiculos');
            $table->timestamps();
            $table->string('origen');
            $table->string('destino');
            $table->string('duración');
            $table->integer('idCuenta')->unsigned()->nullable();
            $table->foreign('idCuenta')->references('id')->on('cuentas');
            $table->integer('idTarjeta')->unsigned()->nullable();
            $table->foreign('idTarjeta')->references('id')->on('tarjetas');
            $table->decimal('monto');
            $table->string('observaciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('viajes');
    }
}
