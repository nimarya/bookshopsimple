<?php

namespace App\Entities;

use Nimarya\Simple\Entities\Model;
use Nimarya\Simple\Entities\Config;
use Nimarya\Simple\Entities\DataBase;

class Comment extends Model
{
    const TABLE = 'feedback';
    private string $bookid;
    private string $name;
    private string $opinion;

    public static function getComments(int $id): array
    {
        $config = Config::make();
        $database = DataBase::make($config->dsn, $config->login, $config->password);

        $substitution = [':id' => $id];
        $sql = "SELECT feedback.id, feedback.name, feedback.opinion 
        FROM books INNER JOIN feedback  
           ON books.id = feedback.bookid
           WHERE books.id = :id";
        return $database->query($sql, static::class, $substitution);
    }


    public function getBookid()
    {
        return $this->bookid;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getOpinion()
    {
        return $this->opinion;
    }
}
