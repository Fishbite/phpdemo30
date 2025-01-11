<?php

namespace Core\Middleware;

class Guest {

    public function handle() {

        // let's confirm you are a guest
        // if a session user exists, you are not allowed to be here, so redirect
        if ($_SESSION['user'] ?? false) {

            header('location: /');
            exit();
        }
    }
}