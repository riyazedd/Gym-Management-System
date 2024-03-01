<?php
include '../query.php';

if(isset($_GET['id'])) $id=$_GET['id'];

//Deleting Announcement
$obj=new query();
$obj->delete("announcements",$id);
header('Location:announcement-manage.php');

?>