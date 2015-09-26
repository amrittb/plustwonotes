<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Category;
use App\Http\Controllers\Controller;

use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Http\Request;

/**
 * Class PostController
 * @package App\Http\Controllers
 */
class PostController extends Controller {

    /**
     * A PostRepository instance.
     *
     * @var PostRepositoryInterface
     */
    protected $repo;

    /**
     * Initializes fields and registers middlewares.
     *
     * @param PostRepositoryInterface $repo
     */
    public function __construct(PostRepositoryInterface $repo){
        $this->repo = $repo;
    }

    /**
     * Displays a list of all posts.
     *
     * @return \Illuminate\View\View
     */
    public function index(){
        $posts = $this->repo->allUntrashed();

        return view('posts.admin.index', compact('posts'));
    }

    /**
     * Displays a list of posts for a category
     *
     * @param Category $category
     * @return \Illuminate\View\View
     */
    public function listCategory(Category $category)
    {
        $posts = $this->repo->getForCategory($category);

        return view('posts.index', compact('posts'));
    }
}
