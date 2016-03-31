<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\SavePostRequest;
use App\Models\Category;
use App\Http\Controllers\Controller;

use App\Models\Post;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Repositories\Contracts\SubjectRepositoryInterface;
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
     * A SubjectRepository instance.
     *
     * @var SubjectRepositoryInterface
     */
    protected $subjectRepo;

    /**
     * Initializes fields and registers middlewares.
     *
     * @param PostRepositoryInterface $postRepo
     * @param CategoryRepositoryInterface $categoryRepo
     * @param SubjectRepositoryInterface $subjectRepo
     */
    public function __construct(PostRepositoryInterface $postRepo,CategoryRepositoryInterface $categoryRepo,SubjectRepositoryInterface $subjectRepo){
        $this->postRepo = $postRepo;
        $this->categoryRepo = $categoryRepo;
        $this->subjectRepo = $subjectRepo;

        $this->middleware('auth',['except' => ['index','show','listCategory']]);
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

        return view('posts.admin.index',compact('posts'));
    }

    /**
     * Displays a list of posts for a category
     *
     * @param Category $category
     * @return \Illuminate\View\View
     */
    public function listCategory(Category $category){
        $posts = $this->postRepo->getForCategory($category);

        return view('posts.index', compact('posts','category'));
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
            return redirect(route('posts.create'))->with('message','Post Created!!');
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

        //  Do not redirect back
        //  Instead redirect to the edit form as when slug changes we redirect to correct edit page
        if($result){
            return redirect()->route('posts.edit',['posts' => $post->post_slug])->with('message','Post Updated!');
        } else {
            return redirect()->route('posts.edit',['posts' => $post->post_slug])->withInput()->with('message','Something went wrong!');
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
        $result = $this->postRepo->deletePost($post);

        if($result){
            return redirect()->back()->with('message','Post deleted!');
        } else {
            return redirect()->back()->with('message','Something went wrong!');
        }
    }

    /**
     * Publishes a post.
     *
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function publish(Post $post){
        $result = $this->postRepo->publishPost($post);

        if($result){
            return redirect()->back()->with('message','Post published!');
        } else {
            return redirect()->back()->with('message','Something went wrong!');
        }
    }

    /**
     * Drafts a post.
     *
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function draft(Post $post){
        $result = $this->postRepo->draftPost($post);

        if($result){
            return redirect()->back()->with('message','Post drafted!');
        } else {
            return redirect()->back()->with('message','Something went wrong!');
        }
    }
}
