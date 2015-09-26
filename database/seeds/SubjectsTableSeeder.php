<?php

class SubjectsTableSeeder extends \Illuminate\Database\Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Subject::create([
            'subject_name' => 'Physics',
            'faculty_id' => 1
        ]);

        \App\Models\Subject::create([
            'subject_name' => 'Chemistry',
            'faculty_id' => 1
        ]);

        \App\Models\Subject::create([
            'subject_name' => 'Physics',
            'faculty_id' => 3
        ]);
    }

}