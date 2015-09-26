<?php

class FacultiesTableSeeder extends \Illuminate\Database\Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Faculty::create([
            'faculty_name' => 'Science',
            'grade_id' => 1
        ]);

        \App\Models\Faculty::create([
            'faculty_name' => 'Management',
            'grade_id' => 1
        ]);

        \App\Models\Faculty::create([
            'faculty_name' => 'Science',
            'grade_id' => 2
        ]);

        \App\Models\Faculty::create([
            'faculty_name' => 'Management',
            'grade_id' => 2
        ]);
    }

}