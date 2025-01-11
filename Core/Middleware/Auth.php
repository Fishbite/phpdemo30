<?php

namespace Core\Middleware;

class Auth {

    public function handle() {

        // let's confirm you are an uathorized user
        // if a session user does NOT exist, you are not allowed to be here, so redirect
        if ( !$_SESSION['user'] ?? false ) {

            header('location: /');
            exit();
        }
    }
}