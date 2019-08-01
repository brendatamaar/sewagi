<?php

namespace App\Traits;

use App\Helpers\ImageHelper;

trait Imagable
{

    /**
     * upload file
     */
    public function upload($file, $resize = [], $type = null)
    {
        $upload = ImageHelper::upload($file);
        $origin_data = array_merge($upload, [
            'thumbnail' => 'original',
            'type' => $type
        ]);
        $origin = $this->images()->create($origin_data);
        if (!empty($resize)) {
            foreach ($resize as $size) {
                $uploaded = $this->resize($file, $size);
                $new_data = array_merge($uploaded, [
                    'parent_id' => $origin->id,
                    'thumbnail' => $size,
                    'type' => $type
                ]);
                $this->images()->create($new_data);
            }
        }
        return $origin;
    }

    /**
     * Resize Image
     * @param  image $origin
     */
    public function resize($file, $type = 'thumb', $width = null, $height = null, $crop = 1)
    {
        switch ($type) {
            case 'thumb':
                $width  = 400;
                return ImageHelper::convert($file, $width, $type);
                break;
            case 'medium':
                $width  = 900;
                return ImageHelper::convert($file, $width, $type);
                break;
            case 'large':
                $width  = 1280;
                return ImageHelper::convert($file, $width, $type);
                break;
        }
    }
}
