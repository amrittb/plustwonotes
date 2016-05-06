<?php namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface{

    const USERS_LIMIT = 20;

    /**
     * Returns all active users.
     *
     * @return mixed
     */
    public function allActive() {
        $users = User::active()->paginate(static::USERS_LIMIT);

        return $users;
    }

    /**
     * Updates the user.
     *
     * @param $input
     * @param User $user
     * @return mixed
     */
    public function updateUser($input, User $user) {
        $user->first_name = $input['first_name'];
        $user->middle_name = (trim($input['middle_name']) != "")?$input['middle_name']:null;
        $user->last_name = $input['last_name'];

        if(trim($input['password'] != "")) {
            $user->password = bcrypt($input['password']);
        }

        return $user->save();
    }

    /**
     * Syncs the roles for the user.
     *
     * @param User $user
     * @param array $roleIds
     * @return mixed
     */
    public function syncRoles(User $user, array $roleIds) {
        return $user->roles()->sync($roleIds);
    }
}