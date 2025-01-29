<?php

/**
 * BookRepository
 * Contains the book array and deals with it.
 * Adds, gets all, filters by id, returns by id, removes by id, checks for id 
 */
class BookRepository
{

    //Replace use of with $_SESSION['books'];
    //
    private array $books = [];

    //Add the given book object to the array
    public static function add(object $newBook)
    {
        //$this->books[] = $newBook;
        $_SESSION['books'][] = $newBook;
    }

    public static function getAll()
    {
        $books = $_SESSION['books'];
        return $books;
    }

    //Filters the books array by author id and returns filtered array
    public static function filterById(int $chosenAuthorId)
    {
        $books = $_SESSION['books'];
        $filteredBooks = array_filter($books, function ($book) use ($chosenAuthorId) {
            return $book->getAuthor()->getId() === $chosenAuthorId;
        });
        return $filteredBooks;
    }

    //Returns a book with a certain id
    public static function returnById(int $id)
    {
        $books = $_SESSION['books'];
        foreach ($books as $book) {
            if ($book->getid() == $id) {
                return $book;
            }
        }
    }

    //Removes a book with a certain index make static
    public static function removeById(int $id)
    {
        $books = $_SESSION['books'];
        foreach ($books as $index => $book) {
            if ($book->getId() === $id) {
                // Remove the object at this index
                unset($_SESSION['books'][$index]);
                break; // Exit loop since we found what we needed
            }
        }
    }

    //Checks if a book exists at a certain index and returns bool
    public function checkForId(int $id)
    {
        foreach ($this->books as $book) {
            if ($book->getId() === $id) {
                return true;
            }
        }
        return false;
    }

}