<?php

// login in the user if the credentials match
use Core\App;
use Core\Database;
use Http\Forms\LoginForm;

// set up the DB connection
$db = App::resolve(Database::class);

// this file is responsible for storing the login form details
$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();

// did the form validate successfully?
if ( !$form->validate($email, $password) ) {

    // if the form did not validate, return the view with the errors
    if ( !empty($errors)) {

        return view('session/create.view.php', [

            'errors' => $form->errors()
        ]);
    }
};


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