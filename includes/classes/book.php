<?php
require "config/init.php";
class book{
    private $book_id;
    private $book_name;
    private $author;
    private $ISBN;
    private $publication_date;
    private $publisher;
    private $book_image;
    private $book_genre;

    private $connection;

    public function __construct()
    {
        $this->connection = new init();
    }

    /**
     * @return mixed
     */
    public function getBookId()
    {
        return $this->book_id;
    }

    /**
     * @param mixed $book_id
     */
    public function setBookId($book_id)
    {
        $this->book_id = $book_id;
    }

    /**
     * @return mixed
     */
    public function getBookName()
    {
        return $this->book_name;
    }

    /**
     * @param mixed $book_name
     */
    public function setBookName($book_name)
    {
        $this->book_name = $book_name;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getISBN()
    {
        return $this->ISBN;
    }

    /**
     * @param mixed $ISBN
     */
    public function setISBN($ISBN)
    {
        $this->ISBN = $ISBN;
    }

    /**
     * @return mixed
     */
    public function getPublicationDate()
    {
        return $this->publication_date;
    }

    /**
     * @param mixed $publication_date
     */
    public function setPublicationDate($publication_date)
    {
        $this->publication_date = $publication_date;
    }

    /**
     * @return mixed
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * @param mixed $publisher
     */
    public function setPublisher($publisher)
    {
        $this->publisher = $publisher;
    }

    /**
     * @return mixed
     */
    public function getBookImage()
    {
        return $this->book_image;
    }

    /**
     * @param mixed $book_image
     */
    public function setBookImage($book_image)
    {
        $this->book_image = $book_image;
    }

    /**
     * @return mixed
     */
    public function getBookGenre()
    {
        return $this->book_genre;
    }

    /**
     * @param mixed $book_genre
     */
    public function setBookGenre($book_genre)
    {
        $this->book_genre = $book_genre;
    }

    //select all books
    public function selectBook($start_from,$limit){
        $selectBooksSQL = "Select * from book ORDER BY book_id ASC LIMIT $start_from, $limit";
        return $this->connection->select($selectBooksSQL);
    }

    //select giveaway books
    public function selectGiveaway(){
        $selectGiveawaySQL = "select * from giveaway";
        return $this->connection->select($selectGiveawaySQL);
    }


    //search books
    public function searchBook($search){
        $searchBookSQL = "
                    SELECT * FROM book b
                    WHERE book_name LIKE '%".$search."%'
                    OR author LIKE '%".$search."%' 
                    OR ISBN LIKE '%".$search."%' 
                    OR publication_date LIKE '%".$search."%' 
                    OR publisher LIKE '%".$search."%'
                    OR book_genre LIKE '%".$search."%'
                	";
        return $this->connection->select($searchBookSQL);
    }

    //browse books
    public function browseBook($genre){
        $browseBookSQL = "Select * from book where book_genre='$genre'";
        return $this->connection->select($browseBookSQL);
    }

    //add book
    public function addBook(){
        $bookName= $this->getBookName();
        $author= $this->getAuthor();
        $ISBN = $this->getISBN();
        $publicationDate= $this->getPublicationDate();
        $publisher= $this->getPublisher();
        $bookImage= $this->getBookImage();
        $bookGenre = $this->getBookGenre();

        $addBookSQL = "insert into book(book_name,author,ISBN,publication_date,publisher,book_image,book_genre)
                    values ('$bookName','$author','$ISBN','$publicationDate','$publisher','$bookImage','$bookGenre')";
        $this->connection->CUD($addBookSQL);
    }

    //check ISBN availability
    public function checkISBNAvailability($ISBN){
        $checkISBNAvailabilitySQL = "select * from book where ISBN='$ISBN'";
        if($this->connection->checkRows($checkISBNAvailabilitySQL)>0){
            return true;
        }else{
            return false;
        }
    }

    //select book by id
    public function selectBookByID($book_id){
        $selectBookByIDSQL = "select * from book where book_id=$book_id";
        return $this->connection->select($selectBookByIDSQL);
    }

    //edit book
    public function editBook($book_id){
        $bookName= $this->getBookName();
        $author= $this->getAuthor();
        $ISBN = $this->getISBN();
        $publicationDate= $this->getPublicationDate();
        $publisher= $this->getPublisher();
        $bookGenre = $this->getBookGenre();

        $editBookSQL = "update book
                        set book_name='$bookName',
                            author='$author',
                            ISBN='$ISBN',
                            publication_date='$publicationDate',
                            publisher='$publisher',
                            book_genre='$bookGenre'
                        where book_id=$book_id";
        $this->connection->CUD($editBookSQL);
    }

    //delete book
    public function deleteBook($book_id){
        $deleteBookSQL = "delete from book where book_id=$book_id";
        $this->connection->CUD($deleteBookSQL);
        header("location:admin.php");
    }

    //count book
    public function countBook(){
        $countBookSQL = "select * from book";
        return $this->connection->checkRows($countBookSQL);
    }




}