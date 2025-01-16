<?php

# these routes don't handle request types
// key = uri value = controller path
// return [
//     '/' => 'index.php',
//     '/about' => 'about.php',
//     '/notes' => 'notes/index.php',
//     '/note' => 'notes/show.php',
//     '/notes/create' => 'notes/create.php',
//     '/contact' => 'contact.php',
// ];

##### Refactor to handle request types START #####

// these will populate the `$routes` array in the `class Router{}`
#### static pages
$router->get('/', 'index.php');
$router->get('/about', 'about.php');
$router->get('/contact', 'contact.php');

#### notes - dynamic pages
// only authenticated users can access the notes
$router->get('/notes', 'notes/index.php')->only('auth');
$router->get('/note', 'notes/show.php');
$router->delete('/note', 'notes/destroy.php');

// $router->get('/note/edit', 'notes/edit.php');

$router->get('/note/edit', 'notes/edit.php');
$router->patch('/note', 'notes/update.php');

$router->get('/notes/create', 'notes/create.php');
$router->post('/notes', 'notes/store.php');

$router->get('/register', 'registration/create.php')->only('guest');
$router->post('/register', 'registration/store.php');

$router->get('/login', 'session/create.php')->only('guest');
$router->post('/session', 'session/store.php')->only('guest');
$router->delete('/session', 'session/destroy.php')->only('auth');