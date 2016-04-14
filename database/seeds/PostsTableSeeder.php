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
        $faker = Faker\Factory::create();

        $categories = Category::lists('id');
        $subjects = Subject::lists('id');
        $users = User::lists('id');

        for($i = 0;$i < 60;$i++){
            $subject_id = null;
            $category_id = $faker->randomElement($categories);

            if($category_id != 3){
                $subject_id = $faker->randomElement($subjects);
            }

            $title = $faker->text(50);

            Post::create([
                'post_title' => $title,
                'post_body' => $faker->text(10000),
                'post_slug' => str_slug($title),
                'published_at' => \Carbon\Carbon::now(),
                'category_id' => $category_id,
                'subject_id' => $subject_id,
                'imp' => $faker->boolean(20),
                'user_id' => $faker->randomElement($users),
                'status_id' => $faker->numberBetween(1,3)
            ]);
        }
    }

}