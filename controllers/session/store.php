<?php

// login in the user if the credentials match
use Core\App;
use Core\Database;
use Core\Validator;

// set up the DB connection
$db = App::resolve(Database::class);

// this file is responsible for storing the login form details
$email = $_POST['email'];
$password = $_POST['password'];

// validate the form inputs
$errors = [];
if (!Validator::email($email)) {

    $errors['email'] = 'Please provide a valid email address';
}

if (!Validator::string($password)) {

    $errors['password'] = 'Please provide a valid password';
}

if ( !empty($errors)) {

    return view('session/create.view.php', [

        'errors' => $errors
    ]);
}

// match the credentials
$user = $db->query('SELECT * FROM users WHERE email = :email', [
    'email' => $email
])->find();

if ( $user ) {

    // we have a user, but does the password match?
    if (password_verify($password, $user['password'])) {

        login([

            'email' =>$email
        ]);

        header('location: /');
        exit();

    }
}



return view('session/create.view.php', [
    'errors' => [
        'email' => 'no matching account for that email address and password.']
]);