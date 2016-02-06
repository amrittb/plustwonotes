<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\SubjectRepositoryInterface;
use App\Http\ViewComposers\Contracts\ViewComposerInterface;

class SavePostComposer implements ViewComposerInterface{
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepo;
    /**
     * @var SubjectRepositoryInterface
     */
    private $subjectRepo;

    /**
     * @param CategoryRepositoryInterface $categoryRepo
     * @param SubjectRepositoryInterface $subjectRepo
     */
    public function __construct(CategoryRepositoryInterface $categoryRepo,SubjectRepositoryInterface $subjectRepo){

        $this->categoryRepo = $categoryRepo;
        $this->subjectRepo = $subjectRepo;
    }

    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view){
        $categories = $this->categoryRepo->allForSelect();
        $subjects = $this->subjectRepo->allForSelect(true);

        $view->with('categories',$categories)
            ->with('subjects',$subjects);
    }
}