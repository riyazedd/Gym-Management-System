<?php
session_start();
include '../dbcon.php';

if(isset($_GET['id'])) $id=$_GET['id'];

//Deleting Announcement
$sql="DELETE FROM announcements WHERE id=$id";
if(mysqli_query($conn,$sql)){
    $_SESSION['success']="Annonucement Deleted";
    header('Location:announcement-manage.php');
}

?>