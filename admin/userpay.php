<?php 
include '../dbcon.php';


if(!empty($_POST)){
    $id=$_POST['id'];
    $name=$_POST['fullname'];
    $service=$_POST['services'];
    $amount=$_POST['amount'];
    $plan=$_POST['plan'];
    $total=$_POST['total'];
    $date=date("Y-m-d");
    $sql="UPDATE members SET pay_date='$date', reminder=0 WHERE id='$id'";
    $res=mysqli_query($conn, $sql);
    if($res){
        echo "succesfully paid";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Succesfull</title>
</head>
<body>
    <?php include 'includes/template.php'?>

<div class="content">

</div>


    <?php include 'includes/footer.php'?>