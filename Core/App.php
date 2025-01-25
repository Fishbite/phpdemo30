<?php

// don't forget to include this file in the namespace!
namespace Core;

// this file makes our container class available application wide
/*
    wer're setting up a way to set up our DB object without having to write:

    $config = require base_path('config.php');
    $db = new Database($config['database']);

    every time we need a connection to the database
*/

class App
{

    // somewhere to store our container
    protected static $container;

    // NB: static functions can be called without having to instantiate the class first
    // e.g. App::setContainer(); instead of `$app = new App;` etc...
    // All this function does is `save` our container when we pass it to this function
    // it is an example of a "singleton" which is an object of which you can only ever have one of
    public static function setContainer($container)
    {

        // initialise the container
        static::$container = $container;
    }

    // using App::container will fetch our container object anywhere in our app
    public static function container()
    {

        // initialise the container
        return static::$container;
    }

    // pass the bind task over to our Container class via our container function:
    public static function bind($key, $resolver)
    {

        static::container()->bind($key, $resolver);
    }

    // pass the resolve task over to our Container class via our container function:
    public static function resolve($key)
    {

        return static::container()->resolve($key);
    }
}
