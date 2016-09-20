<?php namespace App\Http\Controllers\Api\v1\Media;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use League\Fractal\TransformerAbstract;
use App\Http\Requests\UploadImageRequest;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Response as IlluminateResponse;

class ImageController extends ApiController {

    /*
     * Thumbnail size of images.
     */
    const THUMBNAIL_SIZE = 150;

    /**
     * Maximum size of images.
     */
    const IMAGE_MAX_SIZE = 1200;

    /**
     * Image path in public directory.
     */
    const IMAGES_PATH = "uploads/images/";

    /**
     * Thumbnail path in public directory.
     */
    const THUMBNAIL_PATH = self::IMAGES_PATH."thumbnails/";

    /**
     * Returns a list of images in storage.
     *
     * @return mixed
     */
    public function index() {
        $files = File::files(public_path(self::IMAGES_PATH));

        return $this->respondWithFiles($files);
    }

    /**
     * Uploads images and sends image information back.
     *
     * @param UploadImageRequest|Request $request
     * @return mixed
     */
    public function upload(UploadImageRequest $request) {
        $files = [];

        foreach($request->file('files') as $file) {
            $path = $file->store('images');

            $publicPath = public_path("uploads/" . $path);

            $this->fitImage($publicPath);

            $files[] = $publicPath;
        }

        return $this->respondWithFiles($files);
    }

    /**
     * Deletes an image.
     *
     * @param $name
     * @return mixed
     */
    public function destroy($name) {
        $path = public_path($this->getPublicImagePath($name));
        $thumbPath = public_path($this->getThumbnailImagePath($name));

        if(File::exists($path) and File::delete($path)) {
            if(File::exists($thumbPath)) {
                File::delete($thumbPath);
            }

            return $this->setStatusCode(IlluminateResponse::HTTP_OK)
                        ->respond([
                            "message" => "File deleted successfully"
                        ]);
        }

        return $this->setStatusCode(IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR)
                    ->respondWithError("File could not be deleted. ".$path);
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
     * Fits an image to maximum dimension.
     *
     * @param $publicPath
     */
    protected function fitImage($publicPath) {
        $image = Image::make($publicPath);
        $width = $image->getWidth();
        $height = $image->getHeight();

        if ($width > self::IMAGE_MAX_SIZE) {
            $image->resize(self::IMAGE_MAX_SIZE, $height / $width * self::IMAGE_MAX_SIZE)->save();
        }
    }

    /**
     * Transforms array of files to JSON Response.
     *
     * @param $files
     * @return mixed
     */
    private function transformFiles($files) {
        $transformed = collect($files)->map(function ($filename,$key) {
            return $this->transformFile($filename);
        })->sortByDesc(function($file,$key) {
            return $file['last_modified_timestamp'];
        });

        return [
            'total' => count($transformed),
            'images' => $transformed
        ];
    }

    /**
     * Transforms a single file to JSON.
     *
     * @param $filename
     * @return array
     */
    protected function transformFile($filename) {
        $name = $this->getFilename($filename);

        $lastModified = File::lastModified($filename);

        $publicPath = $this->getPublicImagePath($name);
        $thumbPath = $this->getThumbnailImagePath($name);

        $this->generateThumbnail($thumbPath, $publicPath);

        return [
            'name' => $name,
            'size' => File::size($filename),
            'last_modified' => Carbon::createFromTimestamp($lastModified)->diffForHumans(),
            'last_modified_timestamp' => $lastModified,
            'public_url' => url($publicPath),
            'thumbnail_url' => url($thumbPath),
        ];
    }

    /**
     * Generates a thumbnail for the file if it does not exist.
     *
     * @param $thumbPath
     * @param $publicPath
     */
    protected function generateThumbnail($thumbPath, $publicPath) {
        $thumbSysPath = public_path($thumbPath);
        $imageSysPath = public_path($publicPath);

        if (!File::exists($thumbSysPath)) {
            $thumbnailDir = public_path(self::THUMBNAIL_PATH);

            if(!File::isDirectory($thumbnailDir)) {
                File::makeDirectory($thumbnailDir);
            }

            Image::make($imageSysPath)->fit(self::THUMBNAIL_SIZE)->save($thumbSysPath);
        }
    }

    /**
     * Returns a file name from a file path.
     *
     * @param $filename
     * @return string
     */
    protected function getFilename($filename) {
        return File::name($filename) . "." . File::extension($filename);
    }

    /**
     * Returns the image path from public directory.
     *
     * @param $name
     * @return string
     */
    protected function getPublicImagePath($name) {
        return self::IMAGES_PATH . $name;
    }

    /**
     * Returns the thumbnail path from public directory.
     *
     * @param $name
     * @return string
     */
    protected function getThumbnailImagePath($name) {
        return self::THUMBNAIL_PATH . $name;
    }

    /**
     * Returns transformer for current resource.
     *
     * @return TransformerAbstract
     */
    protected function getTransformer() {}
}
