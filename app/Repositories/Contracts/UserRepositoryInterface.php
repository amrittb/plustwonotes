<?php namespace App\Repositories\Contracts;

interface UserRepositoryInterface {

    /**
     * Returns all active users.
     *
     * @return mixed
     */
    public function allActive();
}