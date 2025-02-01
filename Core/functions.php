<?php

use Core\Response;

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

function urlIs($value)
{
    return $_SERVER['REQUEST_URI'] === $value;
}

function abort($code = 404)
{
    http_response_code($code);
    require base_path("views/{$code}.php");
    die();
}

function authorize($condition, $status = Response::FORBIDDEN)
{
    if (! $condition) {
        abort($status);
    }
}

function base_path($path)
{
    // append BASE_PATH so we don't have to remember what the path is
    return BASE_PATH . $path; // const BASE_PATH = __DIR__.'/../'
}

function view($path, $attributes = [])
{
    // takes an array and turns it into a set of variables
    // where `key` = var name and `value`= value of the var
    extract($attributes);

    // var_dump($heading);

    require base_path('views/' . $path);
}


function redirect($path)
{
    header("location: {$path}");
    exit();
}

// return old form data i.e. that which the user has entered
// this is useful when you want to re-populate a form
function old($key, $default = '')
{

    return Core\Session::get('old')[$key] ?? $default;
}
