<?php

namespace App\Repositories;


use App\Models\Subject;
use App\Repositories\Contracts\SubjectRepositoryInterface;

class SubjectRepository implements SubjectRepositoryInterface{

    /**
     * Generates a list of subjects to be used in a HTML select.
     *
     * @param bool $hasNA
     * @return array
     */
    public function allForSelect($hasNA = false){
        $subjects = Subject::with('grade')->get();

        $subjectIds = array();
        $subjectNames = array();

        if($hasNA){
            $subjectIds[0] = "0";
            $subjectNames[0] = "-N/A-";
        }

        foreach($subjects as $subject){
            array_push($subjectIds,$subject->id);
            array_push($subjectNames,'Grade '.$subject->grade->grade_name.' '.$subject->subject_name);
        }

        return array_combine($subjectIds,$subjectNames);
    }
}