<?php namespace App\Http\Controllers\Api;

use Illuminate\Http\Response as IlluminateResponse;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use App\Http\Controllers\Controller;
use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;
use Illuminate\Support\Facades\Response;
use Illuminate\Database\Eloquent\Collection as IlluminateCollection;

abstract class ApiController extends Controller{

    /**
     * Fractal Manager
     *
     * @var Manager
     */
    protected $fractal;

    /**
     * ApiController constructor.
     *
     * @param Manager $fractal
     */
    public function __construct(Manager $fractal){
        $this->fractal = $fractal;
    }

    /**
     * Status code for the response.
     *
     * @var int
     */
    protected $statusCode = IlluminateResponse::HTTP_OK;

    /**
     * Returns status code.
     *
     * @return int
     */
    public function getStatusCode() {
        return $this->statusCode;
    }

    /**
     * Sets the status code.
     *
     * @param int $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode) {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * Returns a not found response.
     *
     * @param string $message
     * @return mixed
     */
    public function respondNotFound($message = 'Not Found!') {
        return $this->setStatusCode(IlluminateResponse::HTTP_NOT_FOUND)
                    ->respondWithError($message);
    }

    /**
     * Returns a response with error.
     *
     * @param $message
     * @return mixed
     */
    public function respondWithError($message) {
        return Response::json([
            'errors' => [
                'message' => $message,
                'code' => $this->getStatusCode()
            ]
        ],$this->getStatusCode());
    }

    /**
     * Returns a response.
     *
     * @param $data
     * @return mixed
     */
    public function respond($data) {
        return Response::json($data,$this->getStatusCode());
    }

    /**
     * Transforms a collection to json.
     *
     * @param IlluminateCollection $items
     * @return string
     */
    protected function transformCollection(IlluminateCollection $items) {
        $resource = $this->createCollectionResource($items);

        return $this->fractal->createData($resource)->toArray();
    }

    /**
     * Transforms an item to json.
     *
     * @param $item
     * @return string
     */
    protected function transform($item) {
        $resource = $this->createItemResource($item);

        return $this->fractal->createData($resource)->toArray();
    }

    /**
     * Creates fractal collection resource.
     *
     * @param $items
     * @return Collection
     */
    private function createCollectionResource($items) {
        return new Collection($items, $this->getTransformer());
    }

    /**
     * Creates fractal item resource.
     *
     * @param $item
     * @return Item
     */
    private function createItemResource($item) {
        return new Item($item, $this->getTransformer());
    }

    /**
     * Returns transformer for current resource.
     *
     * @return TransformerAbstract
     */
    abstract protected function getTransformer();
}