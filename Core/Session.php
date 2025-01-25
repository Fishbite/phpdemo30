<?php

namespace Core;

class Session
{

    public static function has($key)
    {

        return (bool) static::get($key);
    }

    public static function put($key, $value)
    {

        $_SESSION[$key] = $value;
    }

    public static function get($key, $default = null)
    {

        return $_SESSION['_flash'][$key] ?? $_SESSION[$key] ?? $default;
    }

    public static function flash($key, $value)
    {

        $_SESSION['_flash'][$key] = $value;
    }

    public static function unflash()
    {

        unset($_SESSION['flash']);
    }

    public static function flush()
    {

        $_SESSION = [];
    }

    public static function destroy()
    {

        // log the user out
        static::flush(); // clear out the current session data
        session_destroy(); // kill the session data on the server

        $params = session_get_cookie_params();
        // to delete the cookie, set the expiriation time in the past `time() - 3600`
        setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
}
