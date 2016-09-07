<?php namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy {

    use HandlesAuthorization;

    /**
     * Determine whether the user can view the users list.
     *
     * @param  User  $authUser
     * @param  User  $user
     * @return mixed
     */
    public function view(User $authUser,User $user) {
        return $user->isActive();
    }

    /**
     * Determine whether the user can view the users list.
     *
     * @param  User  $user
     * @return mixed
     */
    public function viewList(User $user) {
        return $user->hasPermission('user.list');
    }

    /**
     * Determine whether the user can update the user.
     *
     * @param User $authUser
     * @param  User $user
     * @return mixed
     */
    public function update(User $authUser, User $user) {
        return $user->isLoggedIn();
    }

    /**
     * Determine whether the user can update the user roles.
     *
     * @param User $authUser
     * @return mixed
     */
    public function updateRoles(User $authUser) {
        return $authUser->isAdministrator();
    }

    /**
     * Determine whether the user can delete the user.
     *
     * @param User $authUser
     * @param  User $user
     * @return mixed
     */
    public function delete(User $authUser, User $user) {
        return $authUser->hasPermission('user.destroy') and ( ! $user->isLoggedIn());
    }
}
