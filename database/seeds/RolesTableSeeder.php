<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     */
    public function run() {
        $roleNames = ['Student','Content Creator','Publisher','Administrator'];

        $roles = [];

        foreach($roleNames as $key => $value){
            $roles[] = ['name' => $value];
        }

        DB::table('roles')->insert($roles);
    }
}
