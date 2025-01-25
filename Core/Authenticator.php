<?php

##### used to authenticate a user #####
namespace Core;

use Core\Session;

class Authenticator
{

    public function attempt($email, $password)
    {


        // match the credentials
        $user = App::resolve(Database::class)->query('SELECT * FROM users WHERE email = :email', [
            'email' => $email
        ])->find();

        if ($user) {

            // we have a user, but does the password match?
            if (password_verify($password, $user['password'])) {

                $this->login([

                    'email' => $email
                ]);

                return true;
            }
        }

        // else we don't have a user
        return false;
    }

    public function login($user)
    {

        // mark that the user has been registered
        $_SESSION['user'] = [

            'email' => $user['email']
        ];

        // create a  new session id, for security purposes
        session_regenerate_id(true);
    }

    public function logout()
    {

        Session::destroy();
        // // log the user out
        // Session::flush(); // clear out the current session data
        // session_destroy(); // kill the session data on the server

        // $params = session_get_cookie_params();
        // // to delete the cookie, set the expiriation time in the past `time() - 3600`
        // setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);

    }
}
