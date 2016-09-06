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
		$this->call('CategoriesTableSeeder');
		$this->call('GradesTableSeeder');
		$this->call('SubjectsTableSeeder');
		$this->call('UsersTableSeeder');
		$this->call('PostsTableSeeder');
		$this->call('ActionsTableSeeder');
		$this->call('EntitiesTableSeeder');
		$this->call('RolesTableSeeder');
		$this->call('PermissionsTableSeeder');
		$this->call('RolePermissionTableSeeder');
		$this->call('UserRoleTableSeeder');
	}
}
