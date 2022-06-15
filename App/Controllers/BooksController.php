<?php

namespace App\Controllers;

use Nimarya\Simple\Controllers\Controller;
use App\Entities\Book;
use App\Entities\Comment;

class BooksController extends Controller
{

    protected function actionDeleteComment()
    {
        if (!empty($_POST['id'])) {
            $id = (int)$_POST['id'];

            $comment = Comment::getById($id);
            Comment::deleteById($id);
            header("Location: /books/" . $comment->getBookId());
        }
    }


    protected function actionIndex()
    {

        if (!empty($_POST['search'])) {
            $search = $_POST['search'];
            $this->view->generator = Book::findEachSearch($search);
        }
        if (empty($_POST['search'])) {
            if (!empty($_POST['sort'])) {
                $this->view->generator = Book::findEachOrdered();
            } elseif (empty($_POST['sort'])) {
                $this->view->generator = Book::findEach();
            }
        }

        $this->view->display(__DIR__ . '/../../templates/index.php');
    }

    protected function actionShow()
    {
        $this->view->book = Book::getById($this->id);
        $this->view->comments = Comment::getComments($this->id);
        $this->view->display(__DIR__ . '/../../templates/show.php');
    }
}
