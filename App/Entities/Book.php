<?php

namespace App\Entities;

use Nimarya\Simple\Entities\Model;
use Nimarya\Simple\Entities\Config;
use Nimarya\Simple\Entities\DataBase;

class Book extends Model
{
    const TABLE = 'books';
    protected string $title;
    protected string $author;
    protected string $description;
    protected int $price;
    protected string $image;

    public static function findEachOrdered(): iterable
    {
        $config = Config::make();
        $database = DataBase::make($config->dsn, $config->login, $config->password);

        $sql = 'SELECT * FROM ' . static::TABLE . ' ORDER BY price';
        return $database->queryEach($sql, static::class, []);
    }

    //rewrite this method using substitutions!
    public static function findEachSearch(string $search): iterable
    {
        $config = Config::make();
        $database = DataBase::make($config->dsn, $config->login, $config->password);

        $sql = 'SELECT * FROM ' . static::TABLE .
            " WHERE author LIKE '%$search%' OR title LIKE '%$search%'";

        return $database->queryEach($sql, static::class, []);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getImage()
    {
        return $this->image;
    }
}
