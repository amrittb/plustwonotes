<?php

use App\Models\Category;
use App\Models\Subject;
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

        $categoriesCount = Category::count();
        $subjectsCount = Subject::count();

        for($i = 0;$i < 10;$i++){
            $subject_id = null;
            $category_id = $faker->numberBetween(1,$categoriesCount);

            if($category_id != 3){
                $subject_id = $faker->numberBetween(1,$subjectsCount);
            }

            $title = $faker->realText(50);

            \App\Models\Post::create([
                'post_title' => $title,
                'post_body' => $faker->text(1000),
                'post_slug' => str_slug($title),
                'published_at' => \Carbon\Carbon::now(),
                'category_id' => $category_id,
                'subject_id' => $subject_id,
                'user_id' => 1,
                'status_id' => 1
            ]);
        }
    }

}