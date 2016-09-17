<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'username' => $faker->userName,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->safeEmail,
        'avatar' => $faker->imageUrl(),
        'password' => $password ?: $password = bcrypt('password'),
        'status_id' => 1
    ];
});

$factory->define(App\Models\Post::class, function (Faker\Generator $faker) {
    $categories = App\Models\Category::pluck('id')->all();
    $subjects = App\Models\Subject::pluck('id')->all();
    $users = App\Models\User::pluck('id')->all();

    $title = $faker->text(50);

    $subject_id = null;
    $category_id = $faker->randomElement($categories);

    if($category_id != 3){
        $subject_id = $faker->randomElement($subjects);
    }

    return [
       'post_title' => $title,
       'post_body' => $faker->text(10000),
       'post_slug' => str_slug($title),
       'published_at' => \Carbon\Carbon::now(),
       'category_id' => $category_id,
       'subject_id' => $subject_id,
       'imp' => $faker->boolean(20),
       'featured' => $faker->boolean(10),
       'user_id' => $faker->randomElement($users),
       'status_id' => $faker->numberBetween(1,3)
    ];
});