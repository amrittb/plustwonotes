<?php namespace App\Helpers;

class Helper {

    /**
     * Returns maximum file upload limit in bytes.
     *
     * @return mixed
     */
    public static function getMaxUploadLimitInBytes() {
        $max_upload = self::convertToBytes(ini_get('upload_max_filesize'));
        $max_post = self::convertToBytes(ini_get('post_max_size'));
        $memory_limit = self::convertToBytes(ini_get('memory_limit'));
        return min($max_upload, $max_post, $memory_limit);
    }

    /**
     * Converts a given value to bytes.
     *
     * @param $val
     * @return int|string
     */
    private static function convertToBytes($val) {
        $val = trim($val);
        $last = strtolower($val[strlen($val)-1]);
        switch($last) {
            case 'g':
                $val *= 1024;
            case 'm':
                $val *= 1024;
            case 'k':
                $val *= 1024;
                break;
        }
        return $val;
    }
}