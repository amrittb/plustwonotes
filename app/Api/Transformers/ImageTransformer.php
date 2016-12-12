<?php namespace App\Api\Transformers;

use App\Helpers\ImageHelper;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use League\Fractal\TransformerAbstract;

class ImageTransformer extends TransformerAbstract {

    /**
     * Transforms a filename into file array.
     *
     * @param $filename
     * @return array
     */
    public function transform($filename) {
        $name = ImageHelper::getFilename($filename);

        $lastModified = File::lastModified($filename);

        $fullImagePath = ImageHelper::getFullImagePath($name);
        $thumbImagePath = ImageHelper::getThumbnailImagePath($name);
        $featuredImagePath = ImageHelper::getFeaturedImagePath($name);
        $featuredImageThumbnailPath = ImageHelper::getFeaturedImageThumbnailPath($name);

        ImageHelper::generateThumbnail($name);

        $fullImage = Image::make($fullImagePath);
        $thumbImage = Image::make($thumbImagePath);

        $featuredImage = null;

        if(File::exists($featuredImagePath)) {
            $featuredImage = Image::make($featuredImagePath);
        }

        $file = [
            'name' => $name,
            'size' => File::size($filename),
            'last_modified' => Carbon::createFromTimestamp($lastModified)->diffForHumans(),
            'last_modified_timestamp' => $lastModified,
            'full' => [
                'url'       => url($fullImagePath),
                'width'     => $fullImage->getWidth(),
                'height'    => $fullImage->getHeight(),
            ],
            'thumbnail' => [
                'url'       => url($thumbImagePath),
                'width'     => $thumbImage->getWidth(),
                'height'    => $thumbImage->getHeight(),
            ],
        ];

        if($featuredImage != null) {
            $file['featured'] = [
                'url'       => url($featuredImagePath),
                'width'     => $featuredImage->getWidth(),
                'height'    => $featuredImage->getHeight(),
            ];

            $featuredImageThumbnail = null;

            if( ! File::exists($featuredImageThumbnailPath)) {
                ImageHelper::generateFeaturedImageThumbnail($filename);
            }

            $featuredImageThumbnail = Image::make($featuredImageThumbnailPath);

            if($featuredImageThumbnail != null) {
                $file['featured_thumbnail'] = [
                    'url'       => url($featuredImageThumbnailPath),
                    'width'     => $featuredImageThumbnail->getWidth(),
                    'height'    => $featuredImageThumbnail->getHeight(),
                ];
            }
        }

        return $file;
    }
}