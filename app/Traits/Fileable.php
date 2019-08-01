<?php

namespace App\Traits;

use App\Helpers\FileHelper;

trait Fileable
{
    /**
     * upload file
     */
    public function upload($file, $type='')
    {
        $upload = FileHelper::upload($file);
        $fileData = array_merge($upload, [
            'type' => $type,
        ]);
        $file = $this->files()->create($fileData);
        return $file;
    }
}
