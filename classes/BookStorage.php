<?php

class BookStorage
{
    private array $books;

    public function __construct(array $books)
    {
        $this->books = $books;
    }

    public function getBooks(): array
    {
        return $this->books;
    }

    public function getBookById(int $id): array
    {
        foreach ($this->books as $book) {
            if ($book['id'] == $id) {
                return $book;
            }
        }
    }
}
