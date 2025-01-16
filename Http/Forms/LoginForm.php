<?php

namespace Http\Forms;
use Core\Validator;

class LoginForm {

    // we'll use a getter function to access this externally
    protected $errors;

    public function validate($email, $password){

        // validate the form inputs

        if (!Validator::email($email)) {

            $this->errors['email'] = 'Please provide a valid email address';
        }

        if (!Validator::string($password)) {

            $this->errors['password'] = 'Please provide a valid password';
        }

        // the validation class should not be responsible for returning a view
        // if ( !empty($errors)) {

        //     return view('session/create.view.php', [

        //         'errors' => $errors
        //     ]);
        // }

        // So, just return whether the form passed validation or not
        return empty($this->errors); // true or false
    }

    // getter function to 'get' the $errors array
    public function errors(){

        return $this->errors;
    }

}