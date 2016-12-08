<?php namespace App\Repositories\Contracts;

interface GradeRepositoryInterface {

    /**
     * Returns list of all grades.
     *
     * @param $includeSubjects
     * @return mixed
     */
    public function all($includeSubjects = false);
}