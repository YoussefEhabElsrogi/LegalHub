<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

function storeImage(Request $request, string $directory, string $driver)
{
    // 1- Get image
    $image = $request->image;

    // 2- Change its current name
    $newImageName = time() . '-' . $image->getClientOriginalName();

    // 3- Move image to the specified directory in the project
    $image->storeAs($directory, $newImageName, $driver);

    // 4- Return the new image name
    return $newImageName;
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
