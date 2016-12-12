<?php namespace App\Repositories;

use App\Helpers\ImageHelper;
use App\Repositories\Contracts\ImageRepositoryInterface;
use Illuminate\Support\Facades\File;

class ImageRepository implements ImageRepositoryInterface {

    /**
     * Returns all images.
     *
     * @return mixed
     */
    public function getAllImages() {
        return File::files(public_path(ImageHelper::IMAGES_PATH));
    }

    /**
     * Uploads a list of files.
     *
     * @param $files
     * @return array
     */
    public function uploadFiles($files) {
        $uploadedFiles = [];

        foreach($files as $file) {
            $path = $file->store('images');

            $fullImagePath = public_path("uploads/" . $path);

            ImageHelper::fitImage($fullImagePath);

            $uploadedFiles[] = $fullImagePath;
        }

        return $uploadedFiles;
    }

    /**
     * Deletes an image by filename.
     *
     * @param $filename
     * @return bool
     */
    public function deleteImage($filename) {
        return ImageHelper::deleteImage($filename);
    }
}