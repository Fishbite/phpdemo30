<?php

// import  the Database class from the `Core` namespace so that
// we don't have to write new Core\Database() 
// We can now reference the class just by its name `Database()`
use Core\Database;

$config = require base_path('config.php');

// this line triggers the `spl_autoload_register` function that loads the class when required
$db = new Database($config['database']);

$notes = $db->query('select * from notes where user_id = 1')->get();

// dd($_SERVER['REQUEST_METHOD']);

view("notes/index.view.php", [
    'heading' => 'My Notes',
    'notes' => $notes,
]);