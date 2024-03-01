<?php
session_start();
include '../dbcon.php';

//Deleting User
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql="DELETE FROM members WHERE id=$id";
    if(mysqli_query($conn,$sql)){
        $_SESSION['success']="Member Deleted Succesfully";
        header("Location:member-list.php");
    }
}

?>