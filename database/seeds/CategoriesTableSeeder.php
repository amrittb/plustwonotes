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
                'category_slug' => str_slug('notes'),
                'category_desc' => 'Definitely not the phone! Read through our collection of notes on various subjects.',
                'has_subject'   => true,
            ],
            [
                'category_name' => 'Syllabus',
                'category_slug' => str_slug('syllabus'),
                'category_desc' => 'Structure your reading session by going through the syllabus.',
                'has_subject'   => true,
            ],
            [
                'category_name' => 'Blog',
                'category_slug' => str_slug('blog'),
                'category_desc' => 'Need a break or some new info? This is the place! We post about some (air quotes) "pretty fun" stuffs and news related to HSEB.',
                'has_subject'   => false,
            ]
        ];

        DB::table('categories')->insert($categories);
    }

}