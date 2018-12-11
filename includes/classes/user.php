<?php
require "config/init.php";
require "includes/functions/alert.php";
class user{

    private $user_id;
    private $user_name;
    private $email;
    private $address_line_1;
    private $address_line_2;
    private $gender;
    private $date_of_birth;
    private $password;
    private $confirm_password;
    private $new_password;

    private $connection;
    private $alert;

    public function __construct()
    {
        $this->connection = new init();
        $this->alert = new alert();
    }

    /**
     * @return mixed
     */
    public function getNewPassword()
    {
        return $this->new_password;
    }

    /**
     * @param mixed $new_password
     */
    public function setNewPassword($new_password)
    {
        $this->new_password = $new_password;
    }


    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->user_name;
    }

    /**
     * @param mixed $user_name
     */
    public function setUserName($user_name)
    {
        $this->user_name = $user_name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getAddressLine1()
    {
        return $this->address_line_1;
    }

    /**
     * @param mixed $address_line_1
     */
    public function setAddressLine1($address_line_1)
    {
        $this->address_line_1 = $address_line_1;
    }

    /**
     * @return mixed
     */
    public function getAddressLine2()
    {
        return $this->address_line_2;
    }

    /**
     * @param mixed $address_line_2
     */
    public function setAddressLine2($address_line_2)
    {
        $this->address_line_2 = $address_line_2;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getDateOfBirth()
    {
        return $this->date_of_birth;
    }

    /**
     * @param mixed $date_of_birth
     */
    public function setDateOfBirth($date_of_birth)
    {
        $this->date_of_birth = $date_of_birth;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getConfirmPassword()
    {
        return $this->confirm_password;
    }

    /**
     * @param mixed $confirm_password
     */
    public function setConfirmPassword($confirm_password)
    {
        $this->confirm_password = $confirm_password;
    }

    //register new user
    public function register_user(){
        $user_name = $this->getUserName();
        $email = $this->getEmail();
        $address_line_1 = $this->getAddressLine1();
        $address_line_2 = $this->getAddressLine2();
        $gender = $this->getGender();
        $date_of_birth = $this->getDateOfBirth();
        $password = $this->getPassword();
        $confirm_password = $this->getConfirmPassword();

            //checking password
            if($password==$confirm_password){
                $checkEmailSQL = "select * from user where email='$email'";

                //checking whether the email already exists or not
                if($this->connection->checkRows($checkEmailSQL)>0){
                    $this->alert->alert_danger('Sorry email already exists. Please try again!');
                }else{
                    $registerUserSQL = "insert into user(user_name,email,address_line_1,address_line_2,gender,date_of_birth,password,register_type)
                            values('$user_name','$email','$address_line_1','$address_line_2','$gender','$date_of_birth','$password','normal');
                            ";

                    $this->connection->CUD($registerUserSQL);
                    return true;
                }
            }else{
                $this->alert->alert_danger('Password does not match. Please try again!');
            }
    }

    //check email availability
    public function checkEmailAvailability($email){
        $checkEmailSQL = "select * from user where email='$email'";
        if($this->connection->checkRows($checkEmailSQL)>0){
            return true;
        }else{
            return false;
        }
    }


    //user login
    public function userLogin(){
        $email = $this->getEmail();
        $password = $this->getPassword();


        //null validation
        if($email=="" || $password==""){
            $this->alert->alert_danger("Please fill up all the fields");
        }else{
            //admin login
            if($email=="admin@admin.com" and $password=="admin"){
                $_SESSION['user_id']= "admin";
                echo "<script type='text/javascript'>  window.location='index.php'; </script>";
            }elseif($email=="admin@admin.com" and $password!="admin"){
                $this->alert->alert_danger('Sorry Admin! Invalid Credentials. Please Try Again.');
            }
            //user login
            else{
                //checking whether the email exists or not
                $checkEmailSQL = "select * from user where email='$email'";
                if(!$this->connection->checkRows($checkEmailSQL)){
                    $this->alert->alert_danger("Email does not exists.");
                }else{
                    $user_data = $this->connection->select($checkEmailSQL);
                    foreach ($user_data as $userDataRow){
                        $fetchUserPassword = $userDataRow["password"];
                        $fetchUserRegisterType = $userDataRow["register_type"];

                        if($fetchUserRegisterType=='gmail'){
                            $this->alert->alert_danger("Sorry! Your account is registered with your gmail account. Please login with gmail.");
                        }else{
                            //checking password
                            if($password==$fetchUserPassword){
                                $_SESSION['user_id']=$userDataRow["user_id"];
                                $_SESSION['user_name']=$userDataRow["user_name"];
                                $_SESSION['register_type']=$userDataRow["register_type"];
                                echo "<script type='text/javascript'>  window.location='index.php'; </script>";
                            }else{
                                $this->alert->alert_danger("Password does not match. Please try again!");
                            }
                        }
                    }
                }
            }
        }
    }

    //login with gmail
    public function loginOAuth($email,$name){
        $checkEmailSQL = "select * from user where email='$email'";

        //checking whether the email already exists or not
        if($this->connection->checkRows($checkEmailSQL)>0){
            $user_data = $this->connection->select($checkEmailSQL);
            foreach ($user_data as $userDataRow){
                if($userDataRow["register_type"]=="normal"){
                    echo "<script type='text/javascript'>  window.location='login.php?gmailloginfail'; </script>";
                }else{
                    $_SESSION['user_id']=$userDataRow["user_id"];
                    $_SESSION['user_name']=$userDataRow["user_name"];
                    $_SESSION['register_type']=$userDataRow["register_type"];
                    echo "<script type='text/javascript'>  window.location='index.php'; </script>";
                }
            }
        }else{
            $registerUserSQL = "insert into user(user_name,email,register_type)
                values('$name','$email','gmail')";
            $this->connection->CUD($registerUserSQL);
            $user_data = $this->connection->select($checkEmailSQL);
            foreach ($user_data as $userDataRow){
                $_SESSION['user_id']=$userDataRow["user_id"];
                $_SESSION['user_name']=$userDataRow["user_name"];
                $_SESSION['register_type']=$userDataRow["register_type"];
            }
            echo "<script type='text/javascript'>  window.location='index.php'; </script>";
        }
    }


    //select user by id
    public function selectUserById($user_id){
        $selectUserByIdSQL = "select * from user where user_id='$user_id'";
        return $this->connection->select($selectUserByIdSQL);
    }

    //edit user details
    public function editUserDetails($user_id){
        $user_name = $this->getUserName();
        $address_line_1 = $this->getAddressLine1();
        $address_line_2 = $this->getAddressLine2();
        $gender = $this->getGender();
        $date_of_birth = $this->getDateOfBirth();

        $editUserDetailsSQL = "update user
                                set user_name='$user_name',
                                address_line_1='$address_line_1',
                                address_line_2='$address_line_2',
                                gender='$gender',
                                date_of_birth='$date_of_birth'
                                where user_id='$user_id'
                                ";
        $this->connection->CUD($editUserDetailsSQL);
        $this->alert->alert_success('Successfully Edited!');
    }

    //select all user
    public function selectAllUser(){
        $selectAllUserSQL = "select * from user";
        return $this->connection->select($selectAllUserSQL);
    }

    //count users
    public function countAllUser(){
        $countAllUserSQL = "SELECT * FROM user";
        return $this->connection->checkRows($countAllUserSQL);
    }

    //search users
    public function searchUser($search){
        $searchUserSQL = "select * 
                from user
                where user_name like '%".$search."%'
                    OR email like '%".$search."%'
                    OR address_line_1 like '%".$search."%'
                    OR address_line_2 like '%".$search."%'
                    OR date_of_birth like '%".$search."%'
                    OR gender like '%".$search."%'
                    OR register_type like '%".$search."%'
                ";
        return $this->connection->select($searchUserSQL);
    }

    //change password
    public function changePassword($user_id){
        $old_password = $this->getPassword();
        $new_password = $this->getNewPassword();

        $checkPasswordSQL = "select * from user where user_id=$user_id ";

        if ($data=$this->connection->select($checkPasswordSQL)){
            foreach ($data as $row){
                $fetchPassword = $row["password"];
                if ($fetchPassword==$old_password){
                    $changePasswordSQL ="update user set password='$new_password' where user_id=$user_id";
                    $this->connection->CUD($changePasswordSQL);
                    $this->alert->alert_success('Password changed successfully.');
                }else{
                    $this->alert->alert_danger('Old password does not match. Please try again!');
                }
            }
        }
    }

}