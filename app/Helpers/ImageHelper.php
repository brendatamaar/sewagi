<?php

namespace App\Helpers;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class ImageHelper
{
    public static $dir = '';
    public static $parent;
    public static $file_name;
    /**
     * Resize image from given url and size
     * Automatically upload thumbnail
     *
     * @param  string $file
     * @param  integer $height
     * @param  integer $width
     * @param  integer $crop
     * @return string S3 Path
     */
    public static function resize($file, int $width = null, int $height = null, $crop = true)
    {
        $file_name = (!empty($file->getClientOriginalName())) ? $file->getClientOriginalName() : basename($file);
        $img = Image::make($file);
        $old_width = $img->width();
        $old_height = $img->height();

        /* Resize Image */
        if ($crop) {
            if (!empty($width) && !empty($height)) {
                $img = $img->fit($width, $height);
            } else if (!empty($width) && empty($height)) {
                $img = $img->fit($width, $old_height);
            } else if (!empty($height) && empty($width)) {
                $img = $img->fit($old_width, $height);
            }
        } else {
            if (!empty($width) && !empty($height)) {
                $img = $img->resize($width, $height);
            } else if (!empty($width) && empty($height)) {
                $img = $img->widen($width);
            } else if (!empty($height) && empty($width)) {
                $img = $img->heighten($height);
            }
        }

        return Self::putFile($img, $file_name);
    }

    /**
     * Convert Image
     * @param  image   $file
     * @param  int $size
     * @return string S3 Path
     */
    public static function convert($file, int $size = null, string $type = null)
    {
        $file_name = (method_exists($file, 'getClientOriginalName') ? $file->getClientOriginalName() : basename($file));

        $img        = Image::make($file);
        $old_width  = $img->width();
        $old_height = $img->height();

        if ($old_width > $old_height) {
            $img = $img->widen($size);
        } else {
            $img = $img->heighten($size);
        }

        return Self::putFile($img, $file_name);
    }

    /**
     * Upload description
     *
     * @param  string $file
     * @param  string $dir
     * @return object
     **/
    public static function upload($file)
    {
        $file_name = (method_exists($file, 'getClientOriginalName') ? $file->getClientOriginalName() : basename($file));
        $img       = Image::make($file);
        return Self::putFile($img, $file_name);
    }

    public static function getInfo($file)
    {
        $file_name = basename($file);
        $img = Image::make($file);
        return [
            'file_name' => $file_name,
            'size'      => strlen($img->encoded),
            'width'     => $img->width(),
            'height'    => $img->height(),
            'mime_type' => $img->mime(),
        ];
    }

    /**
     * Put a file into S3
     * @param  object $encoded
     * @param  string $dir
     * @return String S3 Path
     */
    public static function putFile($img, string $file_name = null)
    {
        $file_name = $file_name;
        $rand      = str_random(rand(10,50)).time ();
        $key       = sha1($rand);

        $path = '/images/' . date('Y/m/d') . '/' . $key . '/' . $file_name;
        list($type, $ext) = explode('/', $img->mime());
        $img = $img->encode($ext, 90);
        
        Storage::disk('s3')->put($path, $img->encoded, 'public');
        return [
            'size'      => strlen($img->encoded),
            'width'     => $img->width(),
            'height'    => $img->height(),
            'mime_type' => $img->mime(),
            'file_name' => $file_name,
            'path'      => $path,
            // 'url'       => Storage::url($path)
        ];
    }

    /**
     * Delete file from S3
     * @param  string $path
     * @return Boolean
     */
    public static function delete(string $path)
    {
        if (Storage::exists($path)) {
            return Storage::delete($path);
        }

        return false;
    }

    /**
     * Set Directory
     * @param Self
     */
    public static function setDir(string $dir)
    {
        Self::$dir = $dir;
        return;
    }
}
