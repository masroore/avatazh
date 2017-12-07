<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCarMarksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('car_marks', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name');
			$table->integer('id_car_type')->index('id_car_type');
			$table->string('name_rus')->nullable();
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
		Schema::drop('car_marks');
	}

}