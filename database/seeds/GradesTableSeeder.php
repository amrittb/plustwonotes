<?php

use Illuminate\Support\Facades\DB;

class GradesTableSeeder extends \Illuminate\Database\Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $grades = [
            [
                'grade_name' => '11'
            ],
            [
                'grade_name' => '12'
            ]
        ];

        DB::table('grades')->insert($grades);
    }

}