<?php
class init{
    /*
    * Database variables
    */
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $DB = "awec7203035";

    private $connect;

    /*
     * Database connection
     */
    public function __construct()
    {
        $this->connect = new mysqli($this->host, $this->user, $this->password,$this->DB);
        if($this->connect->connect_error){
            die("Database is not connected:" .$this->connect->connect_error);
        }
    }

    /*
     * A function that will be used for inserting,updating and deleting
     */
    public function CUD($sql){
        $this->connect->query($sql);
    }

    /*
     * A function that will be used for checking rows
     */
    public function checkRows($sql){
        $resultSet = $this->connect->query($sql);
        if(is_object($resultSet)){
            $rows = $resultSet->num_rows;
            return $rows;
        }else{
            return false;
        }
    }

    /*
     * A function that will be used for selecting rows
     */
    public function select($sql){
        $data = [];
        $fetchData = $this->connect->query($sql);

        if($fetchData->num_rows > 0){
            while($rows = $fetchData->fetch_assoc())
                $data[] = $rows;
        }else{
            return false;
        }
        return $data;

    }

}
