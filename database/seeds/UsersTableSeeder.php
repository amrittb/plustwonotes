<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(App\Models\User::class,5)->create();

        factory(App\Models\User::class)->create([
            'username' => 'admin',
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@example.com'
        ]);
    }

}