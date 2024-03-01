<?php
include "database.php";


class query extends Database{
    
    //to insert data
    function insert($table,$data){
        array_pop($data);
        $key=implode(',',array_keys($data));
        $value=implode("','",array_values($data));
        $sql="insert into $table ($key) values ('$value')";
        $res=$this->conn->query($sql);
        if($res){
            $_SESSION['success']="Added Successfully";
        }
    }

    //to select and display data
    function select($table){
        $sql="select * from $table";
        return $this->conn->query($sql);
    }

    //to delete data
    function delete($table,$id){
        $sql="delete from $table where id=$id";
        $this->conn->query($sql);
    }

    //to update data
    function update($table,$data=array(),$id){
        array_pop($data);
        $args=array();
        foreach($data as $key=>$value){
            $args[]= "$key='$value'";
        }
        // print_r($args);
        $field=implode(',',$args);
        $sql="update $table set $field where id=$id";
        // echo $sql;
        $res=$this->conn->query($sql);
        if($res){
            $_SESSION['success']="Updated Successfully";
        }
    }

    //to select from id
    function select_id($table,$id){
        $sql="select * from $table where id=$id";
        return $this->conn->query($sql);
    }

}



?>

