<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subjects',function(Blueprint $table){
			$table->increments('id');
			$table->string('subject_name');
			$table->integer('grade_id')->unsigned();

			$table->foreign('grade_id')
				->references('id')->on('grades')
				->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('subjects');
	}

}
