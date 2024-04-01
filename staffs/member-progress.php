<?php
include '../dbcon.php';

//Displaying Members Progress(initial weight, current weight, progress)
$sql = "SELECT members.*,services.service_name, progress.ini_weight, progress.curr_weight, progress.ini_bodytype, progress.curr_bodytype
        FROM members
        LEFT JOIN progress ON members.id = progress.member_id
        LEFT JOIN services ON members.services_id = services.id
        ";

$res = mysqli_query($conn, $sql);
$sn = 1;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FitManage Hub - Staff</title>
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
            <?php while($row=mysqli_fetch_assoc($res)){?>
            <tr>
                <td><?=$sn++?></td>
                <td><?= $row['fullname'] ?></td>
                <td><?= $row['ini_weight'] ?></td>
                <td><?= $row['curr_weight'] ?></td>
                <td><?= $row['service_name'] ?></td>
                <td><?php
                if($row['ini_weight']<$row['curr_weight']){
                    $diff=$row['curr_weight']-$row['ini_weight'];
                    $progress=$diff." Kg Gained";
                    echo $progress;
                }else{
                    $diff=$row['ini_weight']-$row['curr_weight'];
                    $progress=$diff." Kg Lost";
                    echo $progress;
                }
                ?></td>
                <td><a href="member-progress-update.php?id=<?=$row['id']?>"><button class="update">Update</button></a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>


<?php include 'includes/footer.php'?>