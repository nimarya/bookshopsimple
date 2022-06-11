<?php
class DataBase
{
    private PDO $dbh;
    private PDOStatement|false $sth;

    public function __construct(string $dsn, string $login, string $password)
    {
        $this->dbh = new PDO($dsn, $login, $password);
    }

    public function getAllBooks(): array
    {
        $sql = 'SELECT * FROM books';
        $this->sth = $this->dbh->prepare($sql);

        try {
            $this->sth->execute();
        } catch (Exception $e) {
            echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
        }
        return $this->sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFeedback(int $id): array
    {
        $sql = "SELECT feedback.id, feedback.name, feedback.opinion 
        FROM books INNER JOIN feedback  
           ON books.id = feedback.bookid
           WHERE books.id = $id";
        $this->sth = $this->dbh->prepare($sql);

        try {
            $this->sth->execute();
        } catch (Exception $e) {
            echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
        }

        return $this->sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function saveComment(string $name, string $comment, int $id)
    {
        $sql = "INSERT INTO `bookshop`.`feedback` (`bookid`, `name`, `opinion`) 
        VALUES ('$id', '$name', '$comment');";
        $this->sth = $this->dbh->prepare($sql);

        try {
            $this->sth->execute();
        } catch (Exception $e) {
            echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
        }
    }

    public function getBooksOrdered(): array
    {
        $sql = 'SELECT * FROM books ORDER BY price';
        $this->sth = $this->dbh->prepare($sql);

        try {
            $this->sth->execute();
        } catch (Exception $e) {
            echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
        }

        return $this->sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteComment(int $id)
    {
        $sql = "DELETE FROM `bookshop`.`feedback` WHERE  `id`= $id";
        $this->sth = $this->dbh->prepare($sql);

        try {
            $this->sth->execute();
        } catch (Exception $e) {
            echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
        }
    }

    public function addBook(string $title, string $author, string $description, string $price, string $image)
    {
        $sql = "INSERT INTO `bookshop`.`books` (`title`, `author`, `description`, `price`, `image`) VALUES ('$title', '$author', '$description', '$price', '$image')";
        $this->sth = $this->dbh->prepare($sql);

        try {
            $this->sth->execute();
        } catch (Exception $e) {
            echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
        }
    }

    public function findBooks(string $search): array
    {
        $sql = "SELECT * FROM books 
        WHERE author LIKE '%$search%' OR title LIKE '%$search%'";

        $this->sth = $this->dbh->prepare($sql);

        try {
            $this->sth->execute();
        } catch (Exception $e) {
            echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
        }

        return $this->sth->fetchAll(PDO::FETCH_ASSOC);
    }
}
