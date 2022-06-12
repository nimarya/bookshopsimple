<?php

namespace App\Entities;

use Nimarya\Simple\Entities\Model;

class Book extends Model
{
    const TABLE = 'books';
    private string $title;
    private string $author;
    private string $description;
    private int $price;
    private string $image;

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
