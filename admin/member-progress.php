<?php
include '../dbcon.php';

//Displaying Members Progress(initial weight, current weight, progress)
$sql="SELECT * FROM members";
$res=mysqli_query($conn,$sql);
$sn=1;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FitManage Hub - Admin</title>
        <link rel="stylesheet" href="css/member-progress.css">
        <script src="https://kit.fontawesome.com/426c1a4028.js" crossorigin="anonymous"></script>   
    </head>
    <body>
   <?php include 'includes/template.php';?>

<div class="content">
    <h2><i class="fa-solid fa-chart-simple" style="margin-right: 0.5rem"></i>Member's Progrss</h2>
    <?php if(isset($_SESSION['success'])){ ?> <div class="message"><h3><?=$_SESSION['success'];  unset($_SESSION['success'])?></h3></div><?php } ?>
    <table>
        <thead>
            <tr>
                <th>SN</th>
                <th>Fullname</th>   
                <th>Initial Weight</th>
                <th>Current Weight</th>
                <th>Service</th>
                <th>Progress</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($user=mysqli_fetch_assoc($res)){?>
            <tr>
                <td><?=$sn++?></td>
                <td><?=$user['fullname']?></td>
                <td><?=$user['ini_weight']?></td>
                <td><?=$user['curr_weight']?></td>
                <td><?=$user['services']?></td>
                <td><?php
                if($user['ini_weight']<$user['curr_weight']){
                    $diff=$user['curr_weight']-$user['ini_weight'];
                    $progress=$diff." Kg Gained";
                    echo $progress;
                }else{
                    $diff=$user['ini_weight']-$user['curr_weight'];
                    $progress=$diff." Kg Lost";
                    echo $progress;
                }
                ?></td>
                <td><a href="progress-update.php?id=<?=$user['user_id']?>"><button class="update">Update</button></a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>


<?php include 'includes/footer.php'?>