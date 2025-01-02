<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

// hard coded for the moment till we tackle authentication
$currentUserId = 1;

// set up our authorization
$note = $db->query('select * from notes where id = :id', [
    'id' => $_POST['id']
])->findOrFail();

// check the user id and proceed or abort
authorize($note['user_id'] === $currentUserId);

// delete the note if authorized
$db->query('delete from notes where id = :id', [
    'id' => $_GET['id']
]);

// else redirect the user
header('location: /notes');
exit();
