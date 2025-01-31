<?php
include_once 'Author.php';
include_once 'Book.php';
include_once 'BookRepository.php';
include_once 'MainController.php';
include_once 'BookController.php';
include_once 'router.php';

session_start();
//$authors = [];
if (!isset($_SESSION['books'])) {
    $_SESSION['authors'] = [];
    $_SESSION['books'] = []; // Initialize as an empty array
    $_SESSION['id'] = 1;
    include_once 'TestData.php';
}


// $_SESSION['books'][] = $book;

$router = new Router();

$router->processRoute();
session_destroy(); // empty session for testing
