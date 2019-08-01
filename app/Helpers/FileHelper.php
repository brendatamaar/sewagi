<?php

namespace App\Helpers;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class FileHelper
{
    public static $dir = '';
    public static $parent;
    public static $file_name;

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
        return Self::putFile($file, $file_name);
    }

    /**
     * Put a file into S3
     * @param  object $encoded
     * @param  string $dir
     * @return String S3 Path
     */
    public static function putFile($file, string $file_name = null)
    {
        $file_name = $file_name;
        $rand      = str_random(rand(10,50)).time ();
        $key       = sha1($rand);

        $path = '/files/' . date('Y/m/d') . '/' . $key . '/' . str_slug($file_name);
        // list($type, $ext) = explode('/', $file->mime());
        $encoded = file_get_contents($file);
        
        Storage::disk('s3')->put($path, $encoded, 'public');
        return [
            'size'      => strlen($encoded),
            'mime_type' => $file->getMimeType(),
            'file_name' => $file_name,
            'path'      => $path,
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
