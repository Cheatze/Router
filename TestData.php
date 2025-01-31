<?php
// Create new Author instances
$authors[] = new Author('J.K.', 'Rowling', new DateTimeImmutable('1965-07-31'));
$authors[] = new Author('Stephen', 'King', new DateTimeImmutable('1947-09-21'));
$authors[] = new Author('Dan', 'Brown', new DateTimeImmutable('1964-06-22'));
$authors[] = new Author('Bobby', '', new DateTimeImmutable('1970-01-01'));

$_SESSION['authors'] = $authors;

foreach ($authors as $author) {
    // Create two new Book instances for each author
    for ($i = 1; $i <= 2; $i++) {
        $bookTitle = "Book Title $i by " . $author->getFirstName() . " " . $author->getLastName();
        $isbn = "ISBN-$i-" . rand(1000, 9999);
        $publisher = "Publisher $i";
        $publicationDate = new DateTimeImmutable('2023-01-01');
        $pageCount = rand(100, 500);
        $id = $_SESSION['id'];
        // Create a new Book instance
        $newBook = new Book($bookTitle, $author, $isbn, $publisher, $publicationDate, $pageCount, $id);

        // Add the Book instance to the books array
        //$game->addForTest($newBook);
        $_SESSION['books'][] = $newBook;
        $_SESSION['id'] += 1;
    }
}
