<?php namespace App\Http\ViewComposers;

use App\Http\ViewComposers\Contracts\ViewComposerInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Contracts\View\View;

class PostCategoryComposer implements ViewComposerInterface{

    /**
     * Category Repository.
     *
     * @var CategoryRepositoryInterface
     */
    protected $categoryRepo;

    /**
     * Composer Constructor.
     *
     * @param CategoryRepositoryInterface $categoryRepo
     */
    public function __construct(CategoryRepositoryInterface $categoryRepo){
        $this->categoryRepo = $categoryRepo;
    }

    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view) {
        $postCategories = $this->categoryRepo->all();

        $view->with('postCategories',$postCategories);
    }
}