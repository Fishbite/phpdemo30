<?php

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
require base_path('Core/router.php');