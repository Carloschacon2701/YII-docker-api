<?php

namespace app\Factory;

use app\components\BookComponent;

class BookFactory
{
    public $book;
    public function __construct()
    {
        $this->book = new BookComponent();
    }

    public function getAllBooks()
    {
        return $this->book->getAllBooks();
    }

    public function getBookById($id)
    {
        return $this->book->getBookById($id);
    }

    public function createBook($data): array
    {
        return $this->book->createBook($data);
    }

    public function updateBook($id, $data): array
    {
        return $this->book->updateBook($id, $data);
    }

    public function deleteBook($id): array
    {
        return $this->book->deleteBook($id);
    }





}