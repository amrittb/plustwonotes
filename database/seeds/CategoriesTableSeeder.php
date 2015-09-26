<?php

class CategoriesTableSeeder extends \Illuminate\Database\Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Category::create([
            'category_name' => 'Note',
            'category_slug' => 'notes'
        ]);

        \App\Models\Category::create([
            'category_name' => 'Syllabus',
            'category_slug' => 'syllabus'
        ]);

        \App\Models\Category::create([
            'category_name' => 'Blog',
            'category_slug' => 'blog'
        ]);
    }

}