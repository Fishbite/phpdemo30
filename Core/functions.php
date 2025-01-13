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

function login($user){

    // mark that the user has been registered
    $_SESSION['user'] = [

        'email' => $user['email']
    ];

    // create a  new session id, for security purposes
    session_regenerate_id(true);

}

function logout() {

    // log the user out
    $_SESSION = []; // clear out the current session data
    session_destroy(); // kill the session data on the server

        $params = session_get_cookie_params();
    // to delete the cookie, set the expiriation time in the past `time() - 3600`
    setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);

}