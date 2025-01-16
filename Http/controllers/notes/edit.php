<?php

// import  the Database class from the `Core` namespace so that
// we don't have to write new Core\Database() 
// We can now reference the class just by its name `Database()`
use Core\App; // our aplication wide class
use Core\Database;

// set up our db connection using our App class
$db = App::resolve(Database::class);

$currentUserId = 1;

$note = $db->query('select * from notes where id = :id', [
    'id' => $_GET['id']
])->findOrFail();

authorize($note['user_id'] === $currentUserId);


view("notes/edit.view.php", [
    'heading' => 'Edit Note',
    'errors' => [],
    'note' => $note
]);