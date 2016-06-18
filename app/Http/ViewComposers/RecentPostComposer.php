<?php namespace App\Http\ViewComposers;

use App\Http\ViewComposers\Contracts\ViewComposerInterface;
use App\Models\Role;
use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Contracts\View\View;

class RecentPostComposer implements ViewComposerInterface {

    /**
    * Post Repository instance.
    *
    * @var PostRepositoryInterface
    */
    protected $postRepo;

    /**
    * Create a RecentPostComposer object
    *
    * @param PostRepositoryInterface $postRepo
    */
    public function __construct(PostRepositoryInterface $postRepo) {
        $this->postRepo = $postRepo;
    }

    /**
     * Bind data to the view.
     *
     * @param View $view
     */
    public function compose(View $view) {
        $posts = $this->postRepo->getRecentPosts();

        $view->with('recentPosts',$posts);
    }
}
