<?php namespace App\Http\ViewComposers;

use App\Http\ViewComposers\Contracts\ViewComposerInterface;
use App\Repositories\Contracts\GradeRepositoryInterface;
use Illuminate\Contracts\View\View;

class GradesComposer implements ViewComposerInterface {

    /**
     * @var GradeRepositoryInterface
     */
    private $grades;

    /**
     * GradesComposer constructor.
     *
     * @param GradeRepositoryInterface $grades
     */
    public function __construct(GradeRepositoryInterface $grades){
        $this->grades = $grades;
    }

    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view) {
        $view->with('grades', $this->grades->all());
    }
}