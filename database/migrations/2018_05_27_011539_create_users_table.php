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
            $table->string('password');
            $table->string('gender')->nullable();
            $table->string('photo')->nullable();
            $table->string('telephone')->nullable();
            $table->boolean('active')->default(True);  
            $table->timestamps();
            $table->rememberToken();
            $table->time('deleted_at')->nullable();
            $table->integer('reputation')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::enableForeignKeyConstraints();
        Schema::dropIfExists('users');
        
    }
}
