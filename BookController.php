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
        echo 'Id: ' . $id;

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

}