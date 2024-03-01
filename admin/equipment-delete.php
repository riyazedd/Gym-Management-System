<?php 
session_start();
include '../dbcon.php';

//Deleting Equipment
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql="DELETE FROM equipment WHERE id=$id";
    if(mysqli_query($conn,$sql)){
        $_SESSION['success']="Equipment Deleted";
        header('Location:equipment-list.php');
    }
}

?>