<?php 
include '../dbcon.php';

//Active Member Count
$sql="SELECT * FROM members WHERE status='Active'";
$result=mysqli_query($conn,$sql);
$activeCount=mysqli_num_rows($result);

//Registered Member Count
$sql="SELECT * FROM members";
$result=mysqli_query($conn,$sql);
$memberCount=mysqli_num_rows($result);

// Total Earning
$sql = "SELECT SUM(s.cost) AS total_earning 
        FROM members m 
        LEFT JOIN services s ON m.services_id = s.id";
$sum = mysqli_query($conn, $sql);
$row_amount = mysqli_fetch_assoc($sum);
$total_earning = $row_amount['total_earning'];

//Total Announcements
$sql="SELECT * FROM announcements";
$res=mysqli_query($conn,$sql);
$num=mysqli_num_rows($res);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FitManage Hub - Admin</title>
        <link rel="stylesheet" href="css/dashboard.css">
        <script src="https://kit.fontawesome.com/426c1a4028.js" crossorigin="anonymous"></script>   
    </head>
    <body>
        
       <?php include 'includes/template.php';?>
<div class="content">
    <div class="stats">
        <div class="stat-box">
            <i class="fa-solid fa-user-check active"></i>
            <h2 class="num"><?=$activeCount?></h2>
            <h2>Active Members</h2>
        </div>
        <div class="stat-box">
            <i class="fa-solid fa-users"></i>
            <h2 class="num"><?=$memberCount?></h2>
            <h2>Registered Members</h2>
        </div>
        <div class="stat-box">
            <i class="fa-solid fa-rupee-sign"></i>
            <h2 class="num"><?=$total_earning?></h2>
            <h2>Total Earning</h2>
        </div>
        <div class="stat-box">
            <i class="fa-solid fa-bullhorn"></i>
            <h2 class="num"><?=$num?></h2>
            <h2>Announcements</h2>
        </div>
    </div>
</div>




<?php include 'includes/footer.php'?>