<?php

namespace Core;

class Router {

    // array to hold the routes is not accessible outside this object
    protected $routes = [];

    // helper function that appends route info
    public function add($method, $uri, $controller) {

        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method
        ];
    }

    #### methods for each request type ####
    public function get($uri, $controller) {
        
        // push the route to the $routes array
        $this->add('GET', $uri, $controller);
    }

    public function post($uri, $controller) {

         // push the route to the $routes array
         $this->add('POST', $uri, $controller);
    }

    public function delete($uri, $controller) {

         // push the route to the $routes array
         $this->add('DELETE', $uri, $controller);
    }

    public function patch($uri, $controller) {

         // push the route to the $routes array
         $this->add('PATCH', $uri, $controller);
    }

    public function put($uri, $controller) {

         // push the route to the $routes array
         $this->add('PUT', $uri, $controller);
    }

    // accept the uri and a request method
    public function route($uri, $method) {

        // loop over the routes in the $routes array ($this->routes)
        foreach($this->routes as $route) {

            // dd($route);

            // echo $uri . ' :- ' . $route['uri'] . '<br>';
            // echo $method . ' :- ' . $route['method'] . '<br>';
            // echo var_dump($_POST) . '<br>';


            // match the incoming `$uri` with the uri in the $route array
            // & match `$route['method]` with the current incoming $method forced to uppercase
            if($route['uri'] === $uri && $route['method'] === strtoupper($method)) {

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