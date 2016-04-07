<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EntitiesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     */
    public function run() {
        $entityNames = ['Post','User','Comment','Discussion'];

        $entities = array_build($entityNames,function($key,$value){
            return [
                $key, ['name' => $value]
            ];
        });

        DB::table('entities')->insert($entities);
    }
}
