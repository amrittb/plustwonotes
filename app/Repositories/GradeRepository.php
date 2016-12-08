<?php namespace App\Repositories;

use App\Models\Grade;
use App\Repositories\Contracts\GradeRepositoryInterface;

class GradeRepository implements GradeRepositoryInterface {

    /**
     * Returns list of all grades.
     *
     * @param $includeSubjects
     * @return mixed
     */
    public function all($includeSubjects = false) {
        if($includeSubjects) {
            return Grade::with('subjects')->get();
        }

        return Grade::all();
    }
}