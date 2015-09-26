<?php

use Illuminate\Support\Facades\DB;

class SubjectsTableSeeder extends \Illuminate\Database\Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = [
            ['subject_name' => 'Physics','grade_id' => 1],
            ['subject_name' => 'Chemistry','grade_id' => 1],
            ['subject_name' => 'Biology','grade_id' => 1],
            ['subject_name' => 'Maths','grade_id' => 1],
            ['subject_name' => 'English','grade_id' => 1],
            ['subject_name' => 'Computer','grade_id' => 1],
            ['subject_name' => 'Business Maths','grade_id' => 1],
            ['subject_name' => 'Economics','grade_id' => 1],
            ['subject_name' => 'Accountancy','grade_id' => 1],
            ['subject_name' => 'Physics','grade_id' => 2],
            ['subject_name' => 'Chemistry','grade_id' => 2],
            ['subject_name' => 'Biology','grade_id' => 2],
            ['subject_name' => 'Maths','grade_id' => 2],
            ['subject_name' => 'English','grade_id' => 2],
            ['subject_name' => 'Computer','grade_id' => 2],
            ['subject_name' => 'Business Maths','grade_id' => 2],
            ['subject_name' => 'Economics','grade_id' => 2]
        ];

        DB::table('subjects')->insert($subjects);
    }

}