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
            ['subject_name' => 'Physics','grade_id' => 1,'subject_slug' => str_slug('Physics')],
            ['subject_name' => 'Chemistry','grade_id' => 1,'subject_slug' => str_slug('Chemistry')],
            ['subject_name' => 'Biology','grade_id' => 1,'subject_slug' => str_slug('Biology')],
            ['subject_name' => 'Maths','grade_id' => 1,'subject_slug' => str_slug('Maths')],
            ['subject_name' => 'English','grade_id' => 1,'subject_slug' => str_slug('English')],
            ['subject_name' => 'Computer','grade_id' => 1,'subject_slug' => str_slug('Computer')],
            ['subject_name' => 'Business Maths','grade_id' => 1,'subject_slug' => str_slug('Business Maths')],
            ['subject_name' => 'Economics','grade_id' => 1,'subject_slug' => str_slug('Economics')],
            ['subject_name' => 'Accountancy','grade_id' => 1,'subject_slug' => str_slug('Accountancy')],
            ['subject_name' => 'Physics','grade_id' => 2,'subject_slug' => str_slug('Physics')],
            ['subject_name' => 'Chemistry','grade_id' => 2,'subject_slug' => str_slug('Chemistry')],
            ['subject_name' => 'Biology','grade_id' => 2,'subject_slug' => str_slug('Biology')],
            ['subject_name' => 'Maths','grade_id' => 2,'subject_slug' => str_slug('Maths')],
            ['subject_name' => 'English','grade_id' => 2,'subject_slug' => str_slug('English')],
            ['subject_name' => 'Computer','grade_id' => 2,'subject_slug' => str_slug('Computer')],
            ['subject_name' => 'Business Maths','grade_id' => 2,'subject_slug' => str_slug('Business Maths')],
            ['subject_name' => 'Economics','grade_id' => 2,'subject_slug' => str_slug('Economics')]
        ];

        DB::table('subjects')->insert($subjects);
    }

}
