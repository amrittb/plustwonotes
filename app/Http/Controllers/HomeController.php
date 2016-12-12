<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller {

    /**
     * PostRepository object.
     *
     * @var PostRepositoryInterface
     */
    protected $postRepo;

    /**
     * Controller Constructor.
     *
     * @param PostRepositoryInterface $postRepo
     */
    public function __construct(PostRepositoryInterface $postRepo){
        $this->postRepo = $postRepo;
    }

    /**
     * Index action for home page.
     *
     * @return \Illuminate\View\View
     */
	public function index(){
        $recomendations = $this->postRepo->getRecommended();

        return view('home.index',compact('recomendations'));
    }

    /**
     * About action for about page.
     *
     * @return \Illuminate\View\View
     */
    public function about(){
        return view('home.about');
    }

    /**
     * Searches the site.
     *
     */
    public function search() {
        $input = \Input::all();

        $query = null;
        $posts = [];
        
        if(array_has($input,'q')) {
            $query = $input['q'];
            $posts = $this->postRepo->searchFor($query);
        }

        return view('home.search',compact('posts','query'));

    }

    public function sitemap() {
        return view('home.sitemap');
    }
}
