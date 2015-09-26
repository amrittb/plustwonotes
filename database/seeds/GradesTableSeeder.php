<?php

class GradesTableSeeder extends \Illuminate\Database\Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Grade::create([
            'grade_name' => '11'
        ]);

        \App\Models\Grade::create([
            'grade_name' => '12'
        ]);
    }

}