<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\SavePostRequest;
use App\Models\Category;
use App\Http\Controllers\Controller;

use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryInterface;
use Carbon\Carbon;
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

        return view('posts.index', compact('posts'));
    }

    /**
     * Displays a list of posts for a category
     *
     * @param Category $category
     * @return \Illuminate\View\View
     */
    public function listCategory(Category $category){
        $posts = $this->repo->getForCategory($category);

        return view('posts.index', compact('posts'));
    }

    /**
     * Display a form to create a new Post.
     *
     * @return \Illuminate\View\View
     */
    public function create(){
        return view('posts.admin.create');
    }

    /**
     * Display a single post.
     *
     * @param Post $post
     * @return \Illuminate\View\View
     */
    public function show(Post $post){
        return view('posts.show',compact('post'));
    }

    /**
     * Stores a post to the database.
     *
     * @param SavePostRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SavePostRequest $request){
        $input = $request->all();

        $result = $this->repo->savePost($input);

        if($result){
            return redirect(route('posts.index'))->with('message','Post Created!!');
        } else {
            return redirect()->back()->withInput()->with('message','Something went wrong!');
        }
    }

    /**
     * Display a form to edit a post.
     *
     * @param Post $post
     * @return \Illuminate\View\View
     */
    public function edit(Post $post){
        return view('posts.admin.edit',compact('post'));
    }

    /**
     * Updates a post in the database.
     *
     * @param Post $post
     * @param SavePostRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Post $post,SavePostRequest $request){
        $input = $request->all();

        $result = $this->repo->savePost($input,$post);

        if($result){
            return redirect()->back()->with('message','Post Updated!');
        } else {
            return redirect()->back()->withInput()->with('message','Something went wrong!');
        }
    }

    /**
     * Soft deletes a post.
     *
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Post $post){
        $result = $post->delete();

        if($result){
            return redirect(route('posts.index'))->with('message','Post moved to trash!');
        } else {
            return redirect()->back()->with('message','Something went wrong!');
        }
    }
}
