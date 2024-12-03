<?php

$config = require base_path('config.php');

// this line triggers the `spl_autoload_register` function that loads the class when required
$db = new Database($config['database']);

$notes = $db->query('select * from notes where user_id = 1')->get();

view("notes/index.view.php", [
    'heading' => 'My Notes',
    'notes' => $notes,
]);