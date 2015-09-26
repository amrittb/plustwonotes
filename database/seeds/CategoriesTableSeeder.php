<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Pluralizer;

class CategoriesTableSeeder extends \Illuminate\Database\Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'category_name' => 'Note',
                'category_slug' => str_slug(Pluralizer::plural('Note'))
            ],
            [
                'category_name' => 'Syllabus',
                'category_slug' => str_slug(Pluralizer::plural('Syllabus'))
            ],
            [
                'category_name' => 'Blog',
                'category_slug' => str_slug(Pluralizer::plural('Blog'))
            ]
        ];

        DB::table('categories')->insert($categories);
    }

}