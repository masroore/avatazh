<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestCreditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_credits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('ФИО');
            $table->integer('age')->nullable()->comment('возвраст');
            $table->string('phone')->comment('телефон');
            $table->string('email')->nullable()->comment('email');
            $table->integer('fee')->comment('первоначальный взнос');
            $table->string('ip')->nullable()->comment('ip');
            $table->string('registration')->comment('регион по прописке');
            $table->string('mark')->comment('марка');
            $table->string('model')->comment('модель');
            $table->string('modification')->comment('комплектация');
            $table->integer('id_car')->comment('марка');
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
        Schema::drop('request_credits');
    }
}
