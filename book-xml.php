<?php
header ("Content-Type:text/xml");
if(isset($_GET['download'])){
    header('Content-Disposition: attachment; filename="book.xml"');
}

require "includes/classes/book.php";
$book = new book();


$_xml = '<?xml version="1.0"?>';
$_xml .="<books>";
if($data = $book->selectBookNoLimitation()){
    foreach ($data as $row){
        $_xml .="<book>";
        $_xml .="<name>".$row['book_id']."</name>";
        $_xml .="<author>".$row['book_name']."</author>";
        $_xml .="<ISBN>".$row['book_genre']."</ISBN>";
        $_xml .="<publication_date>".$row['book_genre']."</publication_date>";
        $_xml .="<publisher>".$row['book_genre']."</publisher>";
        $_xml .="<genre>".$row['book_genre']."</genre>";
        $_xml .="</book>";
    }
}
$_xml .="</books>";

//Parse and create an xml object using the string
$xmlObj=new SimpleXMLElement($_xml);

echo $xmlObj->asXML();
exit();

