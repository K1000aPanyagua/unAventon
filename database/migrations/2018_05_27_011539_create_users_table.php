<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('name');
            $table->string('lastname');
            $table->date('birthdate');
            $table->string('pass');
            $table->string('gender')->nullable();
            $table->string('photo')->nullable();
            $table->string('telephone')->nullable();
            $table->boolean('active')->default(True);  
            $table->timestamps();
            $table->rememberToken();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
