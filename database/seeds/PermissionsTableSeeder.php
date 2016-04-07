<?php

use App\Models\Action;
use App\Models\Entity;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     */
    public function run() {
        $entites = Entity::all();
        $actions = Action::all();

        $permissions = [];

        foreach($entites as $entity){
            foreach($actions as $action){
                if(!($entity->name != 'Post' and $action->name == 'Publish')){
                    array_push($permissions,[
                        'entity_id' => $entity->id,
                        'action_id' => $action->id
                    ]);
                }
            }
        }

        DB::table('permissions')->insert($permissions);
    }
}
