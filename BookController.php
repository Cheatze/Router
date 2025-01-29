<?php

class BookController
{
    public static function index()
    {
        if (isset($_SESSION['books'])) {
            $books = BookRepository::getAll();
        } else {
            $books = [];
        }
        include_once 'html/index.html';
    }

    public static function show(int $id)
    {
        $book = BookRepository::returnById($id);
        include_once 'html/book.html';

    }

    public static function delete()
    {
        $id = $_POST["id"];
        BookRepository::removeById($id);
        BookController::index();
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

    public static function form()
    {
        include_once 'html/form.html';
    }

    public static function add()
    {
        // Retrieve form data
        $bookTitle = $_POST['title'];
        //$author = $_POST['author'];
        foreach ($_SESSION['authors'] as $auth) {
            if ($auth->getName() == $_POST['author']) {
                $author = $auth;
                break;
            }
        }
        $isbn = $_POST['isbn'];
        $publisher = $_POST['publisher'];
        $publicationDate = $_POST['publicationDate'];
        $pageCount = $_POST['pageCount'];

        // Create a new Book object
        $newBook = new Book($bookTitle, $author, $isbn, $publisher, $publicationDate, $pageCount);

        BookRepository::add($newBook);
        BookController::index();
    }
}