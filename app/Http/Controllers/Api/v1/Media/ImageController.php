<?php namespace App\Http\Controllers\Api\v1\Media;

use App\Api\Transformers\ImageTransformer;
use App\Models\Post;
use App\Repositories\Contracts\ImageRepositoryInterface;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\TransformerAbstract;
use App\Http\Requests\UploadImageRequest;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Response as IlluminateResponse;

class ImageController extends ApiController {

    /**
     * ImageRepository.
     * 
     * @var ImageRepositoryInterface
     */
    private $images;

    /**
     * ImageController constructor.
     *
     * @param Manager $fractal
     * @param ImageRepositoryInterface $images
     */
    public function __construct(Manager $fractal, ImageRepositoryInterface $images){
        parent::__construct($fractal);

        $this->images = $images;
    }

    /**
     * Returns a list of images in storage.
     *
     * @return mixed
     */
    public function index() {
        $files = $this->images->getAllImages();

        return $this->respondWithFiles($files);
    }

    /**
     * Uploads images and sends image information back.
     *
     * @param UploadImageRequest|Request $request
     * @return mixed
     */
    public function upload(UploadImageRequest $request) {
        $files = $this->images->uploadFiles($request->file('files'));

        return $this->respondWithFiles($files);
    }

    /**
     * Deletes an image.
     *
     * @param $name
     * @return mixed
     */
    public function destroy($name) {
        if($this->images->deleteImage($name)) {
            // Removing featured_img column entry for matched featured images.
            $posts = Post::where('featured_img',$name)->get();

            foreach($posts as $post) {
                $post->featured_img = null;
                $post->save();
            }

            return $this->setStatusCode(IlluminateResponse::HTTP_OK)
                        ->respond([
                            "message" => "File deleted successfully"
                        ]);
        }

        return $this->setStatusCode(IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR)
                    ->respondWithError("File could not be deleted. ". $name);
    }

    /**
     * Returns JSON response with files.
     *
     * @param $files
     * @return mixed
     */
    protected function respondWithFiles($files) {
        return $this->respond($this->transformFiles($files));
    }

    /**
     * Transforms array of files to JSON Response.
     *
     * @param $files
     * @return mixed
     */
    private function transformFiles($files) {
        $transformed = $this->transformCollection(collect($files));

        $transformed = collect($transformed["data"])->sortByDesc(function($file,$key) {
            return $file['last_modified_timestamp'];
        });

        return [
            'total' => count($files),
            'images' => $transformed->toArray(),
        ];
    }

    /**
     * Returns transformer for current resource.
     *
     * @return TransformerAbstract
     */
    protected function getTransformer() {
        return new ImageTransformer();
    }
}
