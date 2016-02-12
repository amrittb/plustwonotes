<?php namespace App\Presenters;

use Robbo\Presenter\Presenter;

class PostPresenter extends Presenter{

    /**
     * Presents grade and subject from post model.
     *
     * @return string
     */
    public function presentGradeSubject(){
        if($this->subject != null){
            return 'Grade '.$this->subject->grade->grade_name.' '.$this->subject->subject_name;
        } else {
            return '';
        }
    }
}