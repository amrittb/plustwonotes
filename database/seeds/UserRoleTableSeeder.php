<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserRoleTableSeeder extends Seeder {

    /**
     * Run the databse seeds.
     */
    public function run() {
        $faker = Faker\Factory::create();

        $users = User::all();
        $roles = Role::pluck('id')->all();

        foreach($users as $user){
            $rolesToSave = [];

            $role_ids = $faker->randomElements($roles,$faker->numberBetween(1,count($roles)));

            foreach($role_ids as $id){
                array_push($rolesToSave,Role::find($id));
            }

            $user->roles()->saveMany($rolesToSave);
        }
    }
}
