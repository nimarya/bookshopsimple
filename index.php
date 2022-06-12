<?php
/*
require __DIR__ . '/classes/DataBase.php';
require __DIR__ . '/classes/View.php';
require __DIR__ . '/classes/BookStorage.php';

$dsn = 'mysql:host=127.0.0.1;dbname=bookshop';
$database = new DataBase($dsn, 'root', '');
$books = $database->getAllBooks();

if (!empty($_POST['search'])) {
    if ($database->findBooks($_POST['search']) == NULL) {
        echo 'SORRY, no results for you query';
    }
    if ($database->findBooks($_POST['search']) != NULL) {
        $books = $database->findBooks($_POST['search']);
    }
}

if (!empty($_POST['sort'])) {
    $books = $database->getBooksOrdered();
}

$data = ['books' => $books, 'feedback' => 0];

$view = new View();
$view->render(__DIR__ . '/templates/mainpage.php', $data);
$view->display(__DIR__ . '/templates/mainpage.php', $data);
*/

require_once './autoload.php';
require_once './vendor/autoload.php';

use App\Entities\Book;
use Nimarya\Simple\Entities\View;

$view = new View();
$book = new Book;
$view->generator = Book::findEach();
$view->display(__DIR__ . '/App/templates/mainpage.php');
