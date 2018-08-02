<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rides', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('car_id')->unsigned();
            $table->foreign('car_id')->references('id')->on('cars');
            $table->string('origin');
            $table->string('destination');
            $table->integer('card_id')->unsigned()->nullable();
            $table->foreign('card_id')->references('id')->on('cards');
            $table->decimal('amount');
            $table->string('remarks')->nullable();
            $table->boolean('done')->default(FALSE);
            $table->boolean('paid')->nullable()->default(NULL);
            $table->date('departDate');
            $table->time('departHour');
            $table->integer('durationHour');
            $table->integer('durationMinute');
            $table->datetime('endDate');
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('rides');
        
    }
}
