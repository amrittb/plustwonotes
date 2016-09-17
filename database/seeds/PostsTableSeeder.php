<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(App\Models\Post::class,50)->create();
    }
}