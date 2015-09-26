<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('faculties',function(Blueprint $table){
			$table->increments('id');
			$table->string('faculty_name');
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
		Schema::dropIfExists('faculties');
	}

}
