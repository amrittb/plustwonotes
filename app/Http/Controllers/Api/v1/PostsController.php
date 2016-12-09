<?php namespace App\Http\Controllers\Api\v1;

use App\Api\Transformers\PostTransformer;
use App\Http\Controllers\Api\ApiController;
use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Database\Eloquent\Collection as IlluminateCollection;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\TransformerAbstract;

class PostsController extends ApiController {

    /**
     * @var PostRepositoryInterface
     */
    private $posts;

    /**
     * PostsController constructor.
     *
     * @param Manager $fractal
     * @param PostRepositoryInterface $posts
     */
    public function __construct(Manager $fractal, PostRepositoryInterface $posts){
        parent::__construct($fractal);

        $this->posts = $posts;
    }

    /**
     * Returns list of posts.
     *
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request) {
        $this->parseIncludes($request);

        $posts = $this->posts->allFromOptions($request->all());

        return $this->respond($this->transformCollection($posts));
    }

    /**
     * Returns a post of given id.
     *
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function show(Request $request, $id) {
        $this->parseIncludes($request);

        $post = $this->posts->itemFromOptions($id, $request->all());

        if($post == null) {
            return $this->respondNotFound("Post not found for id {{$id}}");
        }

        return $this->respond($this->transform($post));
    }

    /**
     * Returns transformer for current resource.
     *
     * @return TransformerAbstract
     */
    protected function getTransformer() {
        return new PostTransformer();
    }
}