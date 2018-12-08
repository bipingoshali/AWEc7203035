<?php
include_once 'includes/classes/book.php';
$book=new book();
$book->setBookName('Pjudice');
$book->setAuthor('Austen, Jane');
$book->setISBN('978-0-571-33701');
$book->setPublicationDate('2018-01-08');
$book->setPublisher('Faber & Faber');
$book->setBookGenre('Science Fiction');
$book->setBookImage('abc.jpg');
$book->addBook();
echo 'Book added successfully';


