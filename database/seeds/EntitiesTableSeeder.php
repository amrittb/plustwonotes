<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EntitiesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     */
    public function run() {
        $entityNames = ['Post','User','Comment','Discussion'];

        $entities = [];
        foreach($entityNames as $key => $value){
            $entities[] = ['name' => $value];
        }

        DB::table('entities')->insert($entities);
    }
}
