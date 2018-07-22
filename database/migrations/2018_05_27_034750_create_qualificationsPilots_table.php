<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQualificationsPilotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qualificationsPilots', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('value');
            $table->integer('pilot_id')->unsigned();
            $table->foreign('pilot_id')->references('id')->on('users');
            $table->integer('passenger_id')->unsigned();
            $table->foreign('passenger_id')->references('id')->on('users');
            $table->string('review');
            $table->integer('ride_id')->unsigned();
            $table->foreign('ride_id')->references('id')->on('rides');
            $table->boolean('done')->default(FALSE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('qualificationsPilots');
        
    }
}
