<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('name_imgdrug');
            $table->string('name');
            $table->string('size');
            $table->string('type');
            $table->string('groups');
            $table->string('description');
            $table->string('indication');
            $table->integer('price');
            $table->integer('amout');
            $table->string('unit');
            $table->string('size_imgdrug');
            $table->string('type_imgdrug');
            $table->string('mfg');
            $table->string('exp');
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
        Schema::dropIfExists('stocks');
    }
}
