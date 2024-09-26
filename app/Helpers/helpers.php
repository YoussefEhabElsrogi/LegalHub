<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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


/**
 * Set a flash message in the session.
 *
 * @param  string  $key   The key to identify the flash message.
 * @param  string  $value The message content to be stored in the session.
 * @return void
 */
function setFlashMessage($key, $value)
{
    if (is_string($key) && is_string($value)) {
        Session::flash($key, $value);
    }
}
