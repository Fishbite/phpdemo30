<?php

use Core\Validator;
// import  the Database class from the `Core` namespace so that
// we don't have to write new Core\Database() 
// We can now reference the class just by its name `Database()`
use Core\App; // our aplication wide class
use Core\Database;

// $config = require base_path('config.php');

// // this line triggers the `spl_autoload_register` function that loads the class when required
// $db = new Database($config['database']);

// set up our db connection using our App class
$db = App::resolve(Database::class);

$errors = [];

if (!Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'A body of no more than 1,000 characters is required.';
}

if(! empty($errors)) {
    return view("notes/create.view.php", [
        'heading' => 'Create Note',
        'errors' => $errors
    ]);
}

    $db->query('INSERT INTO notes(body, user_id) VALUES(:body, :user_id)', [
        'body' => $_POST['body'],
        'user_id' => 1
    ]);

    header('location: /notes');
    die();