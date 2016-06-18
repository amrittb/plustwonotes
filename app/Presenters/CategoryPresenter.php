<?php namespace App\Presenters;

use Robbo\Presenter\Presenter;

class CategoryPresenter extends Presenter{

    /**
     * Presents number of published posts for the category.
     *
     * @return mixed
     */
    public function presentNumOfPublishedPosts() {
        return $this->posts()->published()->count();
    }
}