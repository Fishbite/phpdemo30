<?php

use Core\App;
use Core\Container;
use Core\Database;

$container = new Container();

// build the DB object  
$container->bind('Core\Database', function(){

    $config = require base_path('config.php');

    #######################################################
    ##### Update Array key to 'livedb' for production #####
    return new Database($config['database']);
    #######################################################
});

// $db = $container->resolve('Core\Database');

// dd($db);
// $container->resolve('askdjhasdagsfd');

App::setContainer($container);