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
}