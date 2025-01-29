<?php
include_once 'Author.php';
include_once 'Book.php';
include_once 'BookRepository.php';
include_once 'MainController.php';
include_once 'BookController.php';
include_once 'router.php';
//echo "Hello indexed worlds!";
session_start();
//$authors = [];
if (!isset($_SESSION['books'])) {
    $_SESSION['authors'] = [];
    $_SESSION['books'] = []; // Initialize as an empty array
    include_once 'TestData.php';
}
// $author = new Author('Bobby', 'Bobson', new DateTimeImmutable('1970-01-01'));
// $book = new Book("The Story", $author, "12345", "Pinguin", '2023-01-01', 99);


// $_SESSION['books'][] = $book;

$router = new Router();

$router->processRoute();
//session_destroy(); // empty session for testing
