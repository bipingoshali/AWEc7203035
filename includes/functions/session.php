<?php
class session{

    //
    public function normalPageSession(){
        if(isset($_SESSION['user_id'])){
            echo "<script type='text/javascript'>  window.location='index.php'; </script>";
        }
    }

    //it secures registered user page
    public function userPageSession(){
        if(isset($_SESSION['user_id'])){
            //works if admin tries to enter user pages
            if($_SESSION['user_id']=="admin"){
                echo "<script type='text/javascript'>  window.location='index.php'; </script>";
            }
        }else{
            echo "<script type='text/javascript'>  window.location='index.php'; </script>";
        }
    }

    //it secures admin page
    public function adminPageSession(){
        if(isset($_SESSION['user_id'])){
            //works if user tries to enter admin pages
            if($_SESSION['user_id']!="admin"){
                echo "<script type='text/javascript'>  window.location='index.php'; </script>";
            }
        }else{
            echo "<script type='text/javascript'>  window.location='index.php'; </script>";
        }
    }

}