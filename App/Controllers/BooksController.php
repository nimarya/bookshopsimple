<?php

namespace App\Controllers;

use Nimarya\Simple\Controllers\Controller;
use App\Entities\Book;
use App\Entities\Comment;

class BooksController extends Controller
{
    protected function actionCreateBook()
    {
        if (isset($_FILES['myimg'])) {
            if (0 == $_FILES['myimg']['error'] && ($_FILES['myimg']['type'] == 'image/jpeg' || $_FILES['myimg']['type'] == 'image/png')) {
                move_uploaded_file($_FILES['myimg']['tmp_name'], __DIR__ . '/../../images/' . $_FILES['myimg']['full_path']);
            } else {
                echo 'ERROR WITH UPLOADING FILE';
            }
        }

        if (!empty($_POST['title'])) {
            $book = new Book;

            $title = $_POST['title'];
            $author = $_POST['author'];
            $description =  $_POST['description'];
            $price = (int)$_POST['price'];
            $image = '/images/' . $_FILES['myimg']['full_path'];

            $book->setTitle($title);
            $book->setAuthor($author);
            $book->setDescription($description);
            $book->setPrice($price);
            $book->setImage($image);

            $book->insert();
        }

        $this->view->display(__DIR__ . '/../../templates/create.php');
    }

    protected function actionDeleteComment()
    {
        if (!empty($_POST['id'])) {
            $id = (int)$_POST['id'];

            $comment = Comment::getById($id);
            Comment::deleteById($id);
            header("Location: /books/" . $comment->getBookId());
        }
    }

    protected function actionCreateComment()
    {
        if (!empty($_POST['opinion']) && !empty($_POST['name'])) {
            $name = $_POST['name'];
            $opinion = $_POST['opinion'];

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
