<?php

use App\Models\Action;
use App\Models\Entity;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionTableSeeder extends Seeder {

    /**
     * Roles
     *
     * @var array
     */
    protected $roles;

    /**
     * Entities
     *
     * @var array
     */
    protected $entities;

    /**
     * Actions
     *
     * @var array
     */
    protected $actions;

    /**
     * Permissions
     *
     * @var array
     */
    protected $permissions;

    /**
     * Role permissions
     *
     * @var array
     */
    protected $role_permissions = [];

    /**
     * Run the database seeder.
     */
    public function run()
    {
        $this->roles = Role::pluck('id', 'name')->all();
        $this->entities = Entity::pluck('name', 'id')->all();
        $this->actions = Action::pluck('name', 'id')->all();
        $this->permissions = DB::table('permissions')->get();

        foreach ($this->roles as $role => $role_id) {
            foreach($this->permissions as $permission) {
                if($this->{camel_case($role." has permission")}(
                    $this->entities[$permission->entity_id],
                    $this->actions[$permission->action_id]
                ))
                {
                    $this->appendRolePermission($role_id,$permission->id);
                }
            }
        }

        DB::table('role_permission')->insert($this->role_permissions);
    }

    /**
     * Checks if the student has a permission.
     *
     * @param $entity
     * @param $action
     * @return bool
     */
    private function studentHasPermission($entity,$action) {
        if (($entity == "Post" and in_array($action, ["Create", "Update", "Destroy", "Publish"])) or
            ($entity == "User" and in_array($action, ["Create", "List", "Destroy"]))
        ) {
            return false;
        }
        return true;
    }

    /**
     * Checks if the content creator has a permission.
     *
     * @param $entity
     * @param $action
     * @return bool
     */
    private function contentCreatorHasPermission($entity,$action) {
        if (($entity == "Post" and $action == "Publish") or
            ($entity == "User" and in_array($action, ["Create", "Destroy"]) or
            ($entity == "Comment" and in_array($action,["Create","Update","Destroy"])) or
            ($entity == "Discussion" and in_array($action,["Create","Update","Destroy"])))
        ) {
            return false;
        }
        return true;
    }

    /**
     * Checks if the publisher has a permission.
     *
     * @param $entity
     * @param $action
     * @return bool
     */
    private function publisherHasPermission($entity,$action) {
        if (($entity == "Post" and $action == "Create") or
            ($entity == "User" and in_array($action, ["Create", "Destroy"]))
        ) {
            return false;
        }
        return true;
    }

    /**
     * Checks if the administrator has a permission.
     *
     * @param $entity
     * @param $action
     * @return bool
     */
    private function administratorHasPermission($entity,$action) {
        if (($entity == "Post" and in_array($action,["Create","Update","Publish","Destroy"])) or
            ($entity == "User" and in_array($action, ["Create"]) or
            ($entity == "Comment" and in_array($action,["Create","Update","Destroy"])) or
            ($entity == "Discussion" and in_array($action,["Create","Update","Destroy"])))
        ) {
            return false;
        }
        return true;
    }

    /**
     * Appends role and permission to an array.
     *
     * @param $role_id
     * @param $permission_id
     */
    private function appendRolePermission($role_id, $permission_id) {
        array_push($this->role_permissions, [
            'role_id' => $role_id,
            'permission_id' => $permission_id
        ]);
    }
}
