<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

function storeImage(Request $request, string $directory, string $driver = 'uploads')
{
    // 1- Get the uploaded image
    $image = $request->file('image');

    // 2- Check if the uploaded file is an image
    if (!$image || !$image->isValid() || !in_array($image->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif'])) {
        throw new \Exception('الملف المرفوع ليس صورة صالحة');
    }

    // 3- Change its current name
    $newImageName = uniqid('', true) . '-' . time() . '-' . Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $image->getClientOriginalExtension();

    // 4- Move image to the specified directory in the project
    $image->storeAs($directory, $newImageName, $driver);

    // 5- Return the new image name or full path if needed
    return "{$directory}/{$newImageName}";
}

function setFlashMessage($key, $value)
{
    if (is_string($key) && is_string($value)) {
        Session::flash($key, $value);
    }
}
function storeFile($file, $directory, $disk = 'local')
{
    $extension = $file->getClientOriginalExtension();

    $fileName = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '-' . time() . '.' . $extension;

    $path = $file->storeAs($directory, $fileName, $disk);

    return $path;
}
function deleteFile($path, $disk = 'local')
{
    if (Storage::disk($disk)->exists($path)) {
        Storage::disk($disk)->delete($path);
        return true;
    }

    return false;
}
