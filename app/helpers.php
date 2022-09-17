<?php 

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;



/**
 * Установить изображение.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  array  $size
 * @return string|array
 */
function set_images($images, $size = [300, 300]) {
    if (isset($images)) {
        if (is_iterable($images)) {
            $result = [];

            foreach ($images as $image) {
                $result[] = set_images($image);
            }
            return $result;
        } else {
            $filename = $images->getClientOriginalName();

            $images->move(Storage::path('public/images/news/') . 'origin/', $filename);
            $thumbnail = Image::make(Storage::path('public/images/news/') . 'origin/' . $filename);
            $thumbnail->fit($size[0], $size[1]);
            $thumbnail->save(Storage::path('public/images/news/') . 'thumbnail/' . $filename);

            return $filename;
        }

    } else {

        // default
        return '../default-movie.png';
    }
}
