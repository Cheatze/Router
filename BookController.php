<?php

class BookController
{
    public static function index()
    {
        if (isset($_SESSION['books'])) {
            $books = $_SESSION['books'];
        } else {
            $books = [];
        }
        include_once 'html/index.html';
    }

    public static function show(int $id)
    {
        //echo 'Id: ' . $id;

        if (isset($_SESSION['books'])) {
            $books = $_SESSION['books'];
        } else {
            $books = [];
        }
        foreach ($books as $book) {
            if ($book->getid() == $id) {
                //$book = $bookO;
                include_once 'html/book.html';
                break;
            }// else { echo $id . "Book not found"; }
        }

    }

    public static function delete()
    {
        $id = $_POST["id"];
        $books = $_SESSION['books'];
        foreach ($books as $index => $book) {
            if ($book->getId() == $id) {
                echo "Found";
                // Remove the object at this index
                unset($_SESSION['books'][$index]);
                BookController::index();
                break; // Exit loop since we found what we needed
            }
        }
    }

    public static function showAuthors()
    {
        $authors = $_SESSION['authors'];
        include_once 'html/author.html';
    }

    public static function showByAuthor($id)
    {
        $books = BookRepository::filterById($id);
        include_once 'html/listByAuthor.html';
    }
}