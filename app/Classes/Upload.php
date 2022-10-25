<?php

namespace Classes;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

ini_set('memory_limit', '1024M');

trait Upload
{
    public function upload($file, $attr = 'image_upload', $size = ["1920", "1080", 1], $quality = 80)
    {

        $name = md5(time()) . md5(rand(2, 3)) . '.' . 'jpg';
        $thumb = Image::make($file->file($attr))->resize(null, 400, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->crop(400, 400)->stream('jpg', 60);


        $resize = Image::make($file->file($attr))->resize(null, $size[1], function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->fit($size[0], $size[1])->stream('jpg', 60);


        $original = Image::make($file->file($attr))->stream('jpg', $quality);

        $path = Storage::disk('public')->put('images/_thumbs/' . $name, $thumb->__toString());
        $path = Storage::disk('public')->put('images/_resizes/' . $name, $resize->__toString());
        $path = Storage::disk('public')->put('images/originals/' . $name, $original->__toString());

        return $name;
    }
}