<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubjectSlugColumnToSubjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('subjects',function(Blueprint $table) {
			$table->string('subject_slug');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('subjects',function(Blueprint $table) {
			$table->dropColumn('subject_slug');
		});
	}

}
