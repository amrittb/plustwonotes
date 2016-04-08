<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Permission extends Model {

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * Gets permission for an entity and action.
     *
     * @param $entity
     * @param $action
     * @return mixed
     */
    public static function forEntityAction($entity, $action) {
        try{
            $entity = Entity::whereName($entity)->firstOrFail();
            $action = Action::whereName($action)->firstOrFail();
            return Permission::whereEntityId($entity->id)->whereActionId($action->id)->firstOrFail();
        } catch (ModelNotFoundException $e){
            return new Permission();
        }
    }

    /**
     * Defines a relationship with Role Model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles() {
        return $this->belongsToMany('\App\Models\Role','role_permission');
    }
}
