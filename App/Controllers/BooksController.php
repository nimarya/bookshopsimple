<?php

namespace App\Controllers;

use Nimarya\Simple\Controllers\Controller;
use App\Entities\Book;
use App\Entities\Comment;
use App\Helper;

class BooksController extends Controller
{
    protected function actionCreateBook()
    {
        $this->view->display(__DIR__ . '/../../templates/create.php');
    }

    protected function actionSaveBook()
    {
        if (!empty($_POST['title']) && isset($_FILES['myimg'])) {
            $book = new Book;

            $title = $_POST['title'];
            $author = $_POST['author'];
            $description = $_POST['description'];
            $price = (int)$_POST['price'];
            $image = '/images/' . $_FILES['myimg']['full_path'];
            //validation of data - trow exception, if data is incorrect

            $book->setTitle($title);
            $book->setAuthor($author);
            $book->setDescription($description);
            $book->setPrice($price);
            $book->setImage($image);

            $book->insert();
            Helper::uploadImage();
        }

        header("Location: /books");
    }

    protected function actionDeleteComment()
    {
        if (!empty($_POST['id'])) {
            $id = (int)$_POST['id'];
            //validation of data - trow exception, if data is incorrect

            $comment = Comment::getById($id);
            Comment::deleteById($id);
        }

        header("Location: /books/" . $comment->getBookId());
    }

    protected function actionCreateComment()
    {
        if (!empty($_POST['opinion']) && !empty($_POST['name'])) {
            $name = $_POST['name'];
            $opinion = $_POST['opinion'];
            //validation of data - trow exception, if data is incorrect

            $comment = new Comment();
            $comment->setName($name);
            $comment->setOpinion($opinion);
            $comment->setBookId($this->id);

            $comment->insert();
        }

        header("Location: /books/" . $comment->getBookId());
    }

    protected function actionIndex()
    {
        /* if (empty($_POST['sort']) && empty($_POST['search'])) {
            $this->view->generator = Book::findEach();
        }
        if (!empty($_POST['search'])) {
            $search = $_POST['search'];
            $this->view->generator = Book::findEachSearch($search);
        }
        if (!empty($_POST['sort'])) {
            $this->view->generator = Book::findEachOrdered();
        }*/
        $search = '';
        if (!empty($_POST['search'])) {
            $search = $_POST['search'];
        }
        $generator = Helper::chooseGenerator();
        $this->view->generator = Book::$generator($search);

        $this->view->display(__DIR__ . '/../../templates/index.php');
    }

    protected function actionShow()
    {
        $this->view->book = Book::getById($this->id);
        $this->view->comments = Comment::getComments($this->id);

        $this->view->display(__DIR__ . '/../../templates/show.php');
    }
}
