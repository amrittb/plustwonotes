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
     * Remove the given role from the user.
     *
     * @param string $role
     */
    public function removeRole($role){
        if($this->hasRole($role)){
            $this->roles()->detach(
                Role::whereName($role)->firstOrFail()
            );
        }
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

    /**
     * Checks if user is student
     *
     * @return bool
     */
    public function isStudent() {
        return $this->hasRole('Student');
    }

    /**
     * Checks if user is student only
     *
     * @return bool
     */
    public function isStudentOnly() {
        return $this->isStudent() and ($this->roles->count() == 1);
    }

    /**
     * Checks if the user is not a student.
     *
     * @return bool
     */
    public function isNotStudent() {
        return ! $this->isStudent();
    }

    /**
     * Checks if the user is not a student only.
     *
     * @return bool
     */
    public function isNotStudentOnly() {
        return ! $this->isStudentOnly();
    }

    /**
     * Checks if user is content creator
     *
     * @return bool
     */
    public function isContentCreator() {
        return $this->hasRole('Content Creator');
    }

    /**
     * Checks if user is content creator only
     *
     * @return bool
     */
    public function isContentCreatorOnly() {
        return $this->isContentCreator() and ($this->roles->count() == 1);
    }

    /**
     * Checks if the user is not a ContentCreator.
     *
     * @return bool
     */
    public function isNotContentCreator() {
        return ! $this->isContentCreator();
    }

    /**
     * Checks if user is publisher
     *
     * @return bool
     */
    public function isPublisher() {
        return $this->hasRole('Publisher');
    }

    /**
     * Checks if user is publisher only
     *
     * @return bool
     */
    public function isPublisherOnly() {
        return $this->isPublisher() and ($this->roles->count() == 1);
    }

    /**
     * Checks if the user is not a Publisher.
     *
     * @return bool
     */
    public function isNotPublisher() {
        return ! $this->isPublisher();
    }

    /**
     * Checks if user is administrator
     *
     * @return bool
     */
    public function isAdministrator() {
        return $this->hasRole('Administrator');
    }

    /**
     * Checks if user is administrator only
     *
     * @return bool
     */
    public function isAdministratorOnly() {
        return $this->isAdministrator() and ($this->roles->count() == 1);
    }

    /**
     * Checks if the user is not a Administrator.
     *
     * @return bool
     */
    public function isNotAdministrator() {
        return ! $this->isAdministrator();
    }
}