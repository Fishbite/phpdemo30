<?php

namespace Core;

use Core\Middleware\Auth;
use Core\Middleware\Guest;
use Core\Middleware\Middleware;

class Router {

    // array to hold the routes is not accessible outside this object
    protected $routes = [];

    // helper function that appends route info
    public function add($method, $uri, $controller) {

        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'middleware' => null // no middleware by default for this app
        ];

        // return the current instance so that we can continue chaining methods
        // on the routes, specifically, the `only()` method
        return $this;
    }

    #### methods for each request type ####
    public function get($uri, $controller) {
        
        // push the route to the $routes array
        // return whatever the `add()` method returns i.e. the router object
        return $this->add('GET', $uri, $controller);
    }

    public function post($uri, $controller) {

         // push the route to the $routes array
         return $this->add('POST', $uri, $controller);
    }

    public function delete($uri, $controller) {

         // push the route to the $routes array
         return $this->add('DELETE', $uri, $controller);
    }

    public function patch($uri, $controller) {

         // push the route to the $routes array
         return $this->add('PATCH', $uri, $controller);
    }

    public function put($uri, $controller) {

         // push the route to the $routes array
         return $this->add('PUT', $uri, $controller);
    }

    public function only($key) {

        // grab the last route in the routes array and assign our $key to the middleware
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;

        // return $this so that we can potentially chain further methods
        return $this;
    }

    // accept the uri and a request method
    public function route($uri, $method) {

        // loop over the routes in the $routes array ($this->routes)
        foreach($this->routes as $route) {

            // match the incoming `$uri` with the uri in the $route array
            // & match `$route['method]` with the current incoming $method forced to uppercase
            if($route['uri'] === $uri && $route['method'] === strtoupper($method)) {

                if ($route['middleware']){
                    #### A more dynamic way of applying the middleware
                    Middleware::resolve($route['middleware']);
                }


                #### Even this was getting cumbersome:
                // // apply the middlware
                // if ($route['middleware'] === 'guest') {

                //     // let's confirm you are a guest
                //     // if a session user exists, you are not allowed to be here, so redirect
                    
                //     // call the middleware handler function to deal with this
                //     (new Guest)->handle();
                // }

                // if ($route['middleware'] === 'auth') {

                //     // let's confirm you are an uathorized user
                //     // if a session user does NOT exist, you are not allowed to be here, so redirect
                    
                //     // call the middleware handler function to deal with this
                //     (new Auth)->handle();
                // }


                // require the corresponding controller
                return require base_path($route['controller']);
            }
        }

        // echo 'no uri?';
        // if we haven't found a matching uri 
        $this->abort();
    }

    protected function abort($code = 404) {
    http_response_code($code);

    require base_path("views/{$code}.php");

    die();
}

}

//  function routeToController($uri, $routes) {

//     if (array_key_exists($uri, $routes)) {
//         require base_path($routes[$uri]);
//     } else {
//         abort();
//     }
// }

// function abort($code = 404) {
//     http_response_code($code);

//     require base_path("views/{$code}.php");

//     die();
// }

// $routes = require base_path('routes.php');

// $uri = parse_url($_SERVER['REQUEST_URI'])['path'];

// routeToController($uri, $routes);