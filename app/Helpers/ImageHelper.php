<?php namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ImageHelper {

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
     * Featured Image path in public directory.
     */
    const FEATURED_IMAGE_PATH = self::IMAGES_PATH."featured/";

    /**
     * Featured Image Thumbnail Path.
     */
    const FEATURED_IMAGE_THUMBNAIL_PATH = self::FEATURED_IMAGE_PATH."thumbnails/";

    /**
     * Featured Image aspect ratio.
     */
    const FEATURED_IMAGE_ASPECT_RATIO = 1.75;

    /**
     * Featured Image width.
     */
    const FEATURED_IMAGE_WIDTH = 912;

    /**
     * Featured Image height.
     */
    const FEATURED_IMAGE_HEIGHT = self::FEATURED_IMAGE_WIDTH / self::FEATURED_IMAGE_ASPECT_RATIO;

    /**
     * Featured Image thumbnail width.
     */
    const FEATURED_IMAGE_THUMBNAIL_WIDTH = 320;

    /**
     * Featured Image thumbnail height.
     */
    const FEATURED_IMAGE_THUMBNAIL_HEIGHT = self::FEATURED_IMAGE_THUMBNAIL_WIDTH / self::FEATURED_IMAGE_ASPECT_RATIO;

    /**
     * Fits an image to maximum dimension.
     *
     * @param $fullImagePath
     */
    public static function fitImage($fullImagePath) {
        $image = Image::make($fullImagePath);

        $width = $image->getWidth();
        $height = $image->getHeight();

        if ($width > self::IMAGE_MAX_SIZE) {
            $image->resize(self::IMAGE_MAX_SIZE, $height / $width * self::IMAGE_MAX_SIZE)->save();
        }
    }

    /**
     * Generates Image thumbnail.
     *
     * @param $filename
     */
    public static function generateThumbnail($filename) {
        $imageSysPath = public_path(self::getFullImagePath($filename));
        $thumbSysPath = public_path(self::getThumbnailImagePath($filename));

        if (!File::exists($thumbSysPath)) {
            $thumbnailDir = public_path(self::THUMBNAIL_PATH);

            if(!File::isDirectory($thumbnailDir)) {
                File::makeDirectory($thumbnailDir);
            }

            Image::make($imageSysPath)->fit(self::THUMBNAIL_SIZE)->save($thumbSysPath);
        }
    }

    /**
     * Generates Featured Image from filename.
     *
     * @param $filename
     */
    public static function generateFeaturedImage($filename) {
        $fullImageSysPath = public_path(self::getFullImagePath($filename));
        $featuredImageSysPath = public_path(self::getFeaturedImagePath($filename));
        $featuredImageDir = public_path(self::FEATURED_IMAGE_PATH);

        if ( ! File::exists($featuredImageSysPath)) {
            if( !File::isDirectory($featuredImageDir)) {
                File::makeDirectory($featuredImageDir);
            }

            // Generate Actual Featured Image.
            Image::make($fullImageSysPath)
                ->fit(intval(self::FEATURED_IMAGE_WIDTH), intval(self::FEATURED_IMAGE_HEIGHT))
                ->save($featuredImageSysPath);

            self::generateFeaturedImageThumbnail($filename);
        }
    }

    /**
     * Generates Featured Image Thumbnail from filename.
     *
     * @param $filename
     * @return mixed
     */
    public static function generateFeaturedImageThumbnail($filename) {
        $featuredImageSysPath = public_path(self::getFeaturedImagePath($filename));
        $featuredImageThumbnailSysPath = public_path(self::getFeaturedImageThumbnailPath($filename));

        $featuredImageThumbnailDir = public_path(self::FEATURED_IMAGE_THUMBNAIL_PATH);

        if ( ! File::exists($featuredImageThumbnailSysPath)) {
            if ( ! File::isDirectory($featuredImageThumbnailDir)) {
                File::makeDirectory($featuredImageThumbnailDir);
            }

            // Generate Featured Image thumbnail.
            Image::make($featuredImageSysPath)
                ->fit(intval(self::FEATURED_IMAGE_THUMBNAIL_WIDTH), intval(self::FEATURED_IMAGE_THUMBNAIL_HEIGHT))
                ->save($featuredImageThumbnailSysPath);
        }
    }

    /**
     * Deletes an image.
     *
     * @param $filename
     * @return bool
     */
    public static function deleteImage($filename) {
        $fullImagePath = public_path(self::getFullImagePath($filename));
        $thumbnailImagePath = public_path(self::getThumbnailImagePath($filename));
        $featuredImagePath = public_path(self::getFeaturedImagePath($filename));
        $featuredImageThumbnailPath = public_path(self::getFeaturedImageThumbnailPath($filename));

        if(File::exists($fullImagePath) and File::delete($fullImagePath)) {
            if(File::exists($thumbnailImagePath)) {
                File::delete($thumbnailImagePath);
            }

            if(File::exists($featuredImagePath)) {
                File::delete($featuredImagePath);
            }

            if(File::exists($featuredImageThumbnailPath)) {
                File::delete($featuredImageThumbnailPath);
            }

            return true;
        }

        return false;
    }

    /**
     * Returns a file name from a file path.
     *
     * @param $filename
     * @return string
     */
    public static function getFilename($filename) {
        return File::name($filename) . "." . File::extension($filename);
    }

    /**
     * Returns the image path from public directory.
     *
     * @param $filename
     * @return string
     */
    public static function getFullImagePath($filename) {
        return self::IMAGES_PATH . $filename;
    }

    /**
     * Returns the thumbnail path from public directory.
     *
     * @param $filename
     * @return string
     */
    public static function getThumbnailImagePath($filename) {
        return self::THUMBNAIL_PATH . $filename;
    }

    /**
     * Returns the featured image path from public directory.
     *
     * @param $filename
     * @return string
     */
    public static function getFeaturedImagePath($filename) {
        return self::FEATURED_IMAGE_PATH . $filename;
    }

    /**
     * Returns featured image thumbnail path from public directory.
     *
     * @param $filename
     * @return string
     */
    public static function getFeaturedImageThumbnailPath($filename) {
        return self::FEATURED_IMAGE_THUMBNAIL_PATH . $filename;
    }
}