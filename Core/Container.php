<?php

namespace Core;

class Container
{

    protected $bindings = [];

    // function to add something to the Container. The $key
    // holds the name of the object (Core\Database) & the
    // resolver holds the function that builds the object
    public function bind($key, $resolver)
    {

        $this->bindings[$key] = $resolver;
    }

    // function to grab something out of the Container
    public function resolve($key)
    {

        if (!array_key_exists($key, $this->bindings)) {

            throw new \Exception('No matching bindings found for ' . $key);
        }

        $resolver = $this->bindings[$key];

        return call_user_func($resolver);

        
    }
}
