<?php

namespace App\Entities;

use Nimarya\Simple\Entities\Model;
use Nimarya\Simple\Entities\Config;
use Nimarya\Simple\Entities\DataBase;

class Book extends Model
{
    const TABLE = 'books';
    private string $title;
    private string $author;
    private string $description;
    private int $price;
    private string $image;

    public static function findEachOrdered(): iterable
    {
        $config = Config::make();
        $database = DataBase::make($config->dsn, $config->login, $config->password);

        $sql = 'SELECT * FROM ' . static::TABLE . ' ORDER BY price';
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
