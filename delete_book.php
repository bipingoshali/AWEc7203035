<?php
include "includes/classes/book.php";
$book = new book();
$book->deleteBook($_GET['book_id']);