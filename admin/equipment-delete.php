<?php 
include '../query.php';

//Deleting Equipment
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $obj=new query();
    $obj->delete("equipment",$id);
    header('Location:equipment-list.php');
}
?>