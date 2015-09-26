<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for($i = 0;$i < 10;$i++){
            \App\Models\Post::create([
                'post_title' => $faker->realText(100),
                'post_body' => $faker->text(1000),
                'published_at' => \Carbon\Carbon::now(),
                'category_id' => 3,
                'user_id' => 1,
                'status_id' => 1
            ]);
        }
    }

}