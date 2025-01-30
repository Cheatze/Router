<?php

class BookController
{
    /**
     * Assigns the books session variable array to $books through the repository and includes index.html
     * @return void
     */
    public static function index()
    {
        if (isset($_SESSION['books'])) {
            $books = BookRepository::getAll();
        } else {
            $books = [];
        }
        include_once 'html/index.html';
    }

    /**
     * Assigns the book with id of $id to $book through the reopository and includes the book.html
     * @param int $id
     * @return void
     */
    public static function show(int $id)
    {
        $book = BookRepository::returnById($id);
        include_once 'html/book.html';

    }

    /**
     *Removes the book with post id value from the session through the repository and calls the index method
     * @return void
     */
    public static function delete()
    {
        $id = $_POST["id"];
        BookRepository::removeById($id);
        BookController::index();
    }

    /**
     * Assings the session authors array to $authors and includes the auhtor.html
     * @return void
     */
    public static function showAuthors()
    {
        $authors = $_SESSION['authors'];
        include_once 'html/author.html';
    }

    /**
     * Assigns an array filtered by the id of the author through the reposotory to $books and includes the listByAuthor.html
     * @param mixed $id
     * @return void
     */
    public static function showByAuthor($id)
    {
        $books = BookRepository::filterById($id);
        include_once 'html/listByAuthor.html';
    }

    /**
     * Includes the form for adding books
     * @return void
     */
    public static function form()
    {
        include_once 'html/form.html';
    }

    /**
     * Assigns all the POST values to variables using the name of the author to get the right author object from the author session array.
     * Creates a new Book object and adds it to the books session variable through the repository.
     * Calls the index method to return to the list of all books
     * @return void
     */
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

        // Create a new Book object, somehow always gives id of 1
        $newBook = new Book($bookTitle, $author, $isbn, $publisher, $publicationDate, $pageCount);

        BookRepository::add($newBook);
        BookController::index();
    }
}