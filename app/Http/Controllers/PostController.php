<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\SavePostRequest;
use App\Models\Category;
use App\Http\Controllers\Controller;

use App\Models\Post;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\PostRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
    protected $postRepo;

    /**
     * A CategoryRepository instance.
     *
     * @var CategoryRepositoryInterface
     */
    protected $categoryRepo;

    /**
     * Initializes fields and registers middlewares.
     *
     * @param PostRepositoryInterface $postRepo
     * @param CategoryRepositoryInterface $categoryRepo
     */
    public function __construct(PostRepositoryInterface $postRepo,CategoryRepositoryInterface $categoryRepo){
        $this->postRepo = $postRepo;
        $this->categoryRepo = $categoryRepo;
    }

    /**
     * Displays a list of all published posts.
     *
     * @return \Illuminate\View\View
     */
    public function index(){
        $posts = $this->postRepo->allPublished();

        return view('posts.index', compact('posts'));
    }

    /**
     * Displays a list of all posts.
     *
     * @return \Illuminate\View\View
     */
    public function indexAll(){
        $posts = $this->postRepo->allUntrashed();

        return view('posts.index',compact('posts'));
    }

    /**
     * Displays a list of posts for a category
     *
     * @param Category $category
     * @return \Illuminate\View\View
     */
    public function listCategory(Category $category){
        $posts = $this->postRepo->getForCategory($category);

        return view('posts.index', compact('posts'));
    }

    /**
     * Display a form to create a new Post.
     *
     * @return \Illuminate\View\View
     */
    public function create(){
        $categories = $this->categoryRepo->allForSelect();

        return view('posts.admin.create',compact('categories'));
    }

    /**
     * Display a single post.
     *
     * @param Post $post
     * @return \Illuminate\View\View
     */
    public function show(Post $post){
        if(!$post->isPublished()){
            throw new ModelNotFoundException();
        }
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

        $result = $this->postRepo->savePost($input);

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

        $result = $this->postRepo->savePost($input,$post);

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
