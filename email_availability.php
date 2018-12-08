<?php
require "includes/classes/user.php";
$user = new user();
$data = [];
$email = htmlspecialchars($_POST['email']);
try{
    $data['status']=false;
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $data['message'] = "Invalid email format.";
    }else{
        if(!$user->checkEmailAvailability($email)){
            $data['message'] = 'Email id available!';
            $data['status'] = true;
        }else{
            $data['message'] = 'Sorry! This email id is already registered in our system.';
        }
    }
}catch (Exception $exception){
    $data['message'] = $exception->getMessage();
}
echo json_encode($data);