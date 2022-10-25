<?php

namespace Classes;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

ini_set('memory_limit', '1024M');

trait Files
{
    public function getImage($size = '_thumbs', $attr = 'image')
    {

        $path = 'images/';
        $file = $path . $size . "/" . $this->{$attr};

        return Storage::disk('public')->url($file);
    }

    public function deleteImage($attr = 'image')
    {

        $path = 'images/';
        $sizes = ['_thumbs', '_resizes', 'originals'];

        foreach ($sizes as $key => $value) {
            $file = $path . $value . "/" . $this->{$attr};
            return Storage::delete($file);
        }
    }
}
