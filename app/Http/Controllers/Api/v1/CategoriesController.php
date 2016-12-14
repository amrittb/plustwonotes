<?php namespace App\Http\Controllers\Api\v1;

use App\Api\Transformers\CategoryTransformer;
use App\Http\Controllers\Api\ApiController;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\TransformerAbstract;

class CategoriesController extends ApiController {

    /**
     * @var CategoryRepositoryInterface
     */
    private $categories;

    /**
     * CategoriesController constructor.
     *
     * @param Manager $fractal
     * @param CategoryRepositoryInterface $categories
     */
    public function __construct(Manager $fractal, CategoryRepositoryInterface $categories){
        parent::__construct($fractal);

        $this->categories = $categories;
    }

    /**
     * Returns a list of categories.
     *
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request) {
        $this->parseIncludes($request);

        return $this->respond($this->transformCollection($this->categories->all()));
    }

    /**
     * Returns transformer for current resource.
     *
     * @return TransformerAbstract
     */
    protected function getTransformer() {
        return new CategoryTransformer();
    }
}