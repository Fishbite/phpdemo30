<?php


logout();

#### the code below has been wrapped in the function `logout()`
// // log the user out
// $_SESSION = []; // clear out the current session data
// session_destroy(); // kill the session data on the server

// $params = session_get_cookie_params();
// // to delete the cookie, set the expiriation time in the past `time() - 3600`
// setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);



header('location: /');
exit();