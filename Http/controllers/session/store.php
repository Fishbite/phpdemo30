<?php

// login in the user if the credentials match
use Core\Authenticator;
use Http\Forms\LoginForm;

// this file is responsible for storing the login form details

// validate the form
$form = LoginForm::validate($attributes = [

    'email' => $_POST['email'],
    'password' => $_POST['password']

]);


// did the form validate successfully?
$signedIn = (new Authenticator)->attempt(
    $attributes['email'],
    $attributes['password']
);

if (!$signedIn) {
    $form->error(
        'email',
        'No matching account found for that email address and password.'
    )->throw();
}

redirect('/');

// return view('session/create.view.php', [
//     'errors' => [
//         'email' => 'no matching account for that email address and password.'
//     ]
// ]);
