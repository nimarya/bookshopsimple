<?php

require __DIR__ . '/classes/DataBase.php';
require __DIR__ . '/classes/View.php';
require __DIR__ . '/classes/BookStorage.php';

$dsn = 'mysql:host=127.0.0.1;dbname=bookshop';
$database = new DataBase($dsn, 'root', '');
$bookData = $database->getAllBooks();
$bookStorage = new BookStorage($bookData);
$book = $bookStorage->getBookById((int)$_GET['id']);

if (!empty($_POST['comment']) && !empty($_POST['name'])) {
    $database->saveComment($_POST['name'], $_POST['comment'], (int)$_GET['id']);
}

if (!empty($_POST['id'])) {
    $database->deleteComment((int)$_POST['id']);
    //echo 'DELETED', $_POST['id'];
}

$feedback = $database->getFeedback((int)$_GET['id']);
$data = ['book' => $book, 'feedback' => $feedback];

$view = new View();
$view->render(__DIR__ . '/templates/bookpage.php', $data);
$view->display(__DIR__ . '/templates/bookpage.php', $data);
