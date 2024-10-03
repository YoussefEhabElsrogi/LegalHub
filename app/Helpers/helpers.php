<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


function setFlashMessage($key, $value)
{
    if (is_string($key) && is_string($value)) {
        Session::flash($key, $value);
    }
}
