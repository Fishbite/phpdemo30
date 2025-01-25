<?php

##### used to validate form inputs #####

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class LoginForm
{

    // we'll use a getter function to access this externally
    protected $errors = [];


    public function __construct(public array $attributes)
    {
        // validate the form inputs

        if (!Validator::email($attributes['email'])) {

            $this->errors['email'] = 'Please provide a valid email address';
        }

        if (!Validator::string($attributes['password'])) {

            $this->errors['password'] = 'Please provide a valid password';
        }
    }

    public static function validate($attributes)
    {
        $instance = new static($attributes);
        return $instance->failed() ? $instance->throw() : $instance;
    }

    public function throw()
    {
        ValidationException::throw($this->errors(), $this->attributes);
    }

    public function failed()
    {
        
        // return a boolean that indicates whether the form validation failed
        return count($this->errors);
    }

    // getter function to 'get' the $errors array
    public function errors()
    {

        return $this->errors;
    }

    public function error($field, $message)
    {

        $this->errors[$field] = $message;

        return $this;
    }

}
