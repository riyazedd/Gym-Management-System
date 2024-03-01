<?php
include '../query.php';

//Deleting Staffs
if(isset($_GET['id'])) $id=$_GET['id'];

$sql=new query();
$sql->delete("staffs",$id);
header('Location:staff-manage.php');

?>