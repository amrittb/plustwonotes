<?php namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\TransformerAbstract;
use App\Api\Transformers\GradeTransformer;
use App\Http\Controllers\Api\ApiController;
use App\Repositories\Contracts\GradeRepositoryInterface;

class GradesController extends ApiController {

    /**
     * @var GradeRepositoryInterface
     */
    private $grades;

    /**
     * SubjectsController constructor.
     *
     * @param Manager $fractal
     * @param GradeRepositoryInterface $grades
     */
    public function __construct(Manager $fractal, GradeRepositoryInterface $grades){
        parent::__construct($fractal);

        $this->grades = $grades;
    }

    /**
     * Returns all subjects with grade.
     *
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request) {
        $this->parseIncludes($request);

        return $this->transformCollection($this->grades->all($request->has('include')));
    }

    /**
     * Returns transformer for current resource.
     *
     * @return TransformerAbstract
     */
    protected function getTransformer() {
        return new GradeTransformer();
    }
}