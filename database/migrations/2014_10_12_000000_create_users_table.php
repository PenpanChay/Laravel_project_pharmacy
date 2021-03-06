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
            $table->string('code_user');
            $table->string('name');
            $table->string('surname');
            $table->string('name_imguser');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role');
            $table->date('birth');
            $table->integer('age');
            $table->string('sex');
            $table->string('tel');
            $table->string('disease');
            $table->string('drug');
            $table->string('size_imguser');
            $table->string('type_imguser');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
