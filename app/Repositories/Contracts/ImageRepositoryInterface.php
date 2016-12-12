<?php namespace App\Repositories\Contracts;

interface ImageRepositoryInterface {

    /**
     * Returns all images.
     *
     * @return mixed
     */
    public function getAllImages();

    /**
     * Uploads a list of files.
     *
     * @param $files
     * @return array
     */
    public function uploadFiles($files);

    /**
     * Deletes an image.
     *
     * @param $filename
     * @return bool
     */
    public function deleteImage($filename);
}