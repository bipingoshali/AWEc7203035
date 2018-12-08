<?php
require "includes/classes/book.php";
$book = new book();
$data = [];
$ISBN = $_POST['ISBN'];
try{
    $data['status']=false;
    if(!$book->checkISBNAvailability($ISBN)){
        $data['status'] = true;
    }else{
        $data['status'] = false;
    }
}catch (Exception $exception){
    $data['message'] = $exception->getMessage();
}
echo json_encode($data);