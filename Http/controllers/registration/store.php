<?php

use Core\App;
use Core\Database;
use Core\Validator;

// set up the DB connection
$db = App::resolve(Database::class);

// this file is responsible for storing the registration form details
$email = $_POST['email'];
$password = $_POST['password'];

// validate the form inputs
$errors = [];
if (!Validator::email($email)) {

    $errors['email'] = 'Please provide a valid email address';
}

if (!Validator::string($password, 8, 255)) {

    $errors['password'] = 'Please provide a password of 8 characters minimum';
}

if (!empty($errors)) {

    return view('registration/create.view.php', [
        'errors' => $errors
    ]);

}

// check if the account already exists

$user = $db->query('SELECT * FROM users WHERE email = :email', [
    'email' => $email
])->find();

    // if yes, redirect to login page
    if ($user) {

        // an account with that email address already exists
        // so, redirect user to login page (or home page as the login page doesn't exist yet)
        header('location: /');
        
        exit();

    } else {

        // if no, save account to the DB, log the user in and redirect user
        $db->query('INSERT INTO users(email, password) VALUES(:email, :password)', [
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT)
        ]);


        login([

            'email' =>$email
        ]);

        // redirect them to somewhere - homepage for now!
        header('location: /');
        exit();
    }
