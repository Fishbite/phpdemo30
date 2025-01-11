<?php

session_start();

/* Document root / project root:
    
    // document root is the `public` folder which has to be
    // set when the server boots up. The docuent root is set
    // with the command `php -S localhost:8888 -t public`

    // `BASE_PATH` points to the project root: `phpdemo30`
*/
const BASE_PATH = __DIR__.'/../';

// echo 'Arse<br>';
// var_dump(BASE_PATH); // "C:\xampp\htdocs\phpdemo30\public/../"

require BASE_PATH.'Core/functions.php';

// php calls this function automatically when a class is required
spl_autoload_register(function ($class) {

    // Core\Database - need to replace `\` with `/`

    // Note: need to escape the searched for `\` with a `\`
    // use the DIRECTORY_SEPARATOR constant as the `replace`parameter so that it works
    // across multipple OS's

    $class = str_replace(search: '\\', replace: DIRECTORY_SEPARATOR, subject: $class);

    // dd($class);

    require base_path("{$class}.php");
});

// appends BASE_PATH to the given path
// require base_path('Core/router.php');

require base_path('bootstrap.php');

#### refactor
$router = new \Core\Router();

$routes = require base_path('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

// swap this out and call a new method on our `$router`  object
// routeToController($uri, $routes);

// store the request type - remember forms can ONLY handle GET or POST
// $method = $_SERVER['REQUEST_METHOD']; // so:
// check if $_POST has a `_method` attribute (we set that on the form) 
// and use it if it does, otherwise, stick with the default request method:
// $method = isset($_POST['_method']) ? $_POST['_method'] : $_SERVER['REQUEST_METHOD'];
// shortcut method of writing the above:
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

// route the uri to wherever it needs to go i.e. route the request
$router->route($uri, $method);