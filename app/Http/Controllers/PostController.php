<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Post;
use App\Http\Controllers\Controller;

use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Http\Request;

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
     * Displays a list of posts.
     *
     * @param $category
     * @return \Illuminate\View\View
     */
    public function index($category = null){
        if($category != null){
            $posts = $this->repo->getForCategory($category);

            return view('posts.index',compact('posts'));
        } else {
            $posts = $this->repo->allUntrashed();

            return view('posts.admin.index', compact('posts'));
        }
    }
}
