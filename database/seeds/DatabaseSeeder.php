<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('PostsTableSeeder');
		$this->call('CategoriesTableSeeder');
		$this->call('GradesTableSeeder');
		$this->call('FacultiesTableSeeder');
		$this->call('SubjectsTableSeeder');

	}

}
