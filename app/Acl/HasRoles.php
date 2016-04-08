<?php namespace App\Acl;

use App\Models\Permission;
use App\Models\Role;

trait HasRoles {

    /**
     * Checks if the user has a certain permission.
     *
     * @param $permission
     * @return bool
     */
    public function hasPermission($permission) {
        $permission_exploded = explode('.',$permission);

        $entity = ucfirst($permission_exploded[0]);
        $action = ucfirst($permission_exploded[1]);

        return $this->hasRole(Permission::forEntityAction($entity,$action)->roles);
    }

    /**
     * Assign the given role to the user.
     *
     * @param  string $role
     * @return mixed
     */
    public function assignRole($role) {
        return $this->roles()->save(
            Role::whereName($role)->firstOrFail()
        );
    }

    /**
     * Checks if the user has a role.
     *
     * @param $role
     * @return bool
     */
    public function hasRole($role) {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }

        return !! $role->intersect($this->roles)->count();
    }
}