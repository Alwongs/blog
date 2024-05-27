<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Image;

class ImageCategoryHelper extends ImageHelper
{
    const DIR_OBJECT = "categories/";

    const RESOLUTIONS = [
        "previews/" => [450, 300],
        "icons/" => [60, 40],
    ];

    public static function storeImage($image, $albumTitle, $newImageName)
    {
        $image->storeAs(self::DIR_OBJECT . 'originals', $newImageName);

        $imageFile = Image::make(Storage::path(self::DIR_OBJECT . 'originals/') . $newImageName);
        parent::makeAndStoreThumbnails($imageFile, '', $newImageName); 
    }
}