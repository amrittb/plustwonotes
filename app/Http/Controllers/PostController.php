<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\SavePostRequest;
use App\Models\Category;
use App\Http\Controllers\Controller;

use App\Models\Grade;
use App\Models\Post;
use App\Models\Subject;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Repositories\Contracts\SubjectRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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
    public function __construct(PostRepositoryInterface $postRepo,
                                CategoryRepositoryInterface $categoryRepo,
                                SubjectRepositoryInterface $subjectRepo)
    {
        $this->postRepo = $postRepo;
        $this->categoryRepo = $categoryRepo;
        $this->subjectRepo = $subjectRepo;

        $this->middleware('auth',['except' => [
                                                'index',
                                                'show',
                                                'listCategory',
                                                'indexByGrade',
                                                'indexBySubject'
        ]]);


        $this->bindAuthorizationMiddlewares();
    }

    /**
     * Binds authorization middlwares to controller actions.
     *
     * @return void
     */
    private function bindAuthorizationMiddlewares() {
        $this->middleware('can:draft,posts', ['only' => 'draft']);
        $this->middleware('can:publish,posts', ['only' => 'publish']);
        $this->middleware('can:destroy,posts', ['only' => 'destroy']);
        $this->middleware('can:restore,posts', ['only' => 'restore']);
        $this->middleware('can:unpublish,posts', ['only' => 'unpublish']);
        $this->middleware('can:update,posts', ['only' => ['edit', 'update']]);
        $this->middleware('can:contentready,posts', ['only' => 'contentready']);
        $this->middleware('can:create,App\Models\Post', ['only' => ['create', 'store']]);
        $this->middleware('can:viewDeletedList,App\Models\Post', ['only' => 'trashed']);
        $this->middleware('can:viewListInBackend,App\Models\Post', ['only' => 'indexAll']);
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
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function indexAll(Request $request){
        $posts = $this->postRepo->allUntrashed($request->all());

        $query = '';
        if(array_key_exists('q',$request->all())) {
            $query = $request->input('q');
        }

        return view('posts.admin.index',compact('posts', 'query'));
    }

    /**
     * Displays a list of all posts which are of the specified grade.
     *
     * @param \App\Models\Grade $grade
     * @return \Illuminate\View\View
     */
    public function indexByGrade(Grade $grade) {
        $posts = $this->postRepo->allPublishedByGrade($grade);

        return view('posts.index',compact('posts','grade'));
    }

    /**
     * Displays a list of all posts which are of the specified subject.
     *
     * @param Subject $subject
     * @return \Illuminate\View\View
     */
    public function indexBySubject(Grade $grade,Subject $subject) {
       $posts = $this->postRepo->allPublishedBySubject($subject);

       return view('posts.index',compact('posts','subject'));
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
     * Gets trashed posts.
     *
     * @return mixed
     */
    public function trashed() {
        $posts = $this->postRepo->getTrashed();

        return view('posts.admin.index',compact('posts'));
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
     * Restores a post.
     *
     * @param Post $post
     * @return mixed
     */
    public function restore(Post $post) {
        $result = $this->postRepo->restorePost($post);

        if($result){
            return redirect()->back()->with('message','Post restored!');
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
     * Unpublishes a post.
     *
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unpublish(Post $post){
        $result = $this->postRepo->unpublishPost($post);

        if($result){
            return redirect()->back()->with('message','Post unpublished!');
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

    /**
     * Content Ready a post.
     *
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function contentReady(Post $post){
        $result = $this->postRepo->contentReadyPost($post);

        if($result){
            return redirect()->back()->with('message','Post ready to be reviewed!');
        } else {
            return redirect()->back()->with('message','Something went wrong!');
        }
    }
}
