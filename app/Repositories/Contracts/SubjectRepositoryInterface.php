<?php

namespace App\Repositories\Contracts;

interface SubjectRepositoryInterface{

    /*
     *  Getters for subjects
     */
    /**
     * @param bool $hasNA
     * @return mixed
     */
    public function allForSelect($hasNA = false);
}