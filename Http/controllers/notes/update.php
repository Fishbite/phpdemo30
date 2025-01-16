<?php


// import  the Database class from the `Core` namespace so that
// we don't have to write new Core\Database() 
// We can now reference the class just by its name `Database()`
use Core\App; // our aplication wide class
use Core\Database;
use Core\Validator;

#### find the corresponding note
// set up our db connection using our App class
$db = App::resolve(Database::class);

$currentUserId = 1;

$note = $db->query('select * from notes where id = :id', [
    'id' => $_POST['id']
])->findOrFail();

#### authorize that the current user can edit the note
authorize($note['user_id'] === $currentUserId);

#### validate the form
$errors = [];

if (!Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'A body of no more than 1,000 characters is required.';
}

#### if no validation errors, update the record in the DB table
if (count($errors)) {

    return view('notes/edit.view.php', [
        'heading' => 'Edit Note',
        'errors' => $errors,
        'note' => $note
    ]);
}

$db->query('update notes set body = :body where id = :id', [
    'id' => $_POST['id'],
    'body' => $_POST['body']
]);

#### redirect the user
header('location: /notes');
die();