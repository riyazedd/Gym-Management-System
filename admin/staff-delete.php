<?php
session_start();
include '../dbcon.php';

//Deleting Staffs
if(isset($_GET['id'])) $id=$_GET['id'];

$sql="DELETE FROM staffs WHERE id=$id";
if(mysqli_query($conn,$sql)){
    $_SESSION['success']="Staff Member Deleted";
    header('Location:staff-manage.php');
}
