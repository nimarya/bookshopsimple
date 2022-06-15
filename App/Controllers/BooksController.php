<?php

namespace App\Controllers;

use Nimarya\Simple\Controllers\Controller;
use App\Entities\Book;
use App\Entities\Comment;

class BooksController extends Controller
{
    protected function actionIndex()
    {
        $this->view->generator = Book::findEach();
        $this->view->display(__DIR__ . '/../../templates/index.php');
    }

    protected function actionShow()
    {
        $this->view->book = Book::getById($this->id);
        $this->view->comments = Comment::getComments($this->id);
        $this->view->display(__DIR__ . '/../../templates/show.php');
    }
}
