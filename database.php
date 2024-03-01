<?php
session_start();

class Database{
    protected $conn;

    public function __construct(){
        $localhost="localhost";
        $name="root";
        $password="";
        $db_name="gymnsb";

        $this->conn=new mysqli($localhost,$name,$password,$db_name);
        if($this->conn->connect_error){
            die("Error connecting to database");
        }
    }
}


