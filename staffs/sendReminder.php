<?php
include '../dbcon.php';
include "includes/authentication.php";

if(isset($_GET['id'])){
    $id=$_GET['id'];

    $qry="UPDATE members SET reminder = '1' where id=$id";
    $result=mysqli_query($conn,$qry);

    if($result){
        $_SESSION['success']="Alert Sent";
        header("Location:payment.php");
        
    }
}

