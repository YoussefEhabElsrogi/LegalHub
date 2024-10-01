<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;

class ImageService
{
    public static function uploadImage(UploadedFile $image, $directory)
    {
        $newImageName = uniqid() . time() . '-' . $image->getClientOriginalName();
        $image->move(public_path($directory), $newImageName);

        return "{$directory}/{$newImageName}";
    }

    public static function deleteImage($imagePath)
    {
        if (file_exists(public_path($imagePath))) {
            try {
                unlink(public_path($imagePath));
            } catch (\Exception $e) {
                throw new \Exception('فشل حذف الصورة ');
            }
        }
    }
}
