<?php

namespace Core\Middleware;

class Middleware {

    public const MAP = [
        'guest' => Guest::class,
        'auth' => Auth::class
    ];

    public static function resolve($key)
    {

        if (!$key) {
            return;
        }

        // do we have a corresponding middleware class
        $middleware = static::MAP[$key] ?? false;

        // if not, abort
        if (!$middleware) {
            throw new \Exception("no matching middlware found for '{$key}'.");
        }

        // otherwise instantiate it and call the corresponding logic
        (new $middleware)->handle();
    }
}