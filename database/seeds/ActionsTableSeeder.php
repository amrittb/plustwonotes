<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActionsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     */
    public function run() {
        $actionNames = ['Create','Read','Update','List','Destroy','Publish'];

        $actions = array_build($actionNames,function($key,$value){
            return [
                $key, ['name' => $value]
            ];
        });

        DB::table('actions')->insert($actions);
    }
}
