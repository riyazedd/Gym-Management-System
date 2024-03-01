<?php
include '../dbcon.php';

//Display Information
if(isset($_GET['id'])) $id=$_GET['id'];
$sql="SELECT * FROM members WHERE user_id=$id";
$res=mysqli_query($conn,$sql);
while($row=mysqli_fetch_assoc($res)){
    $ini_weight=$row['ini_weight'];
    $curr_weight=$row['curr_weight'];
    if($ini_weight<$curr_weight){
        $diff=$curr_weight-$ini_weight;
        $progress=$diff." Kg Gained";
    }else{
        $diff=$ini_weight-$curr_weight;
        $progress=$diff." Kg Lost";
    }
    
    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FitManage Hub - Admin</title>
        <link rel="stylesheet" href="css/view-progress-report.css">
        <script src="https://kit.fontawesome.com/426c1a4028.js" crossorigin="anonymous"></script>   
    </head>
    <body>
        
        <?php include 'includes/template.php'; ?>
<div class="content">
<h2>Progress Report</h2>
    <div class="progress">
        <p>Member Name: <?=$row['fullname']?></p>
        <p>Member ID: <?=$id?></p>
        <table class="progress-table">
            <thead>
                <tr>
                    <th>Initial Weight</th>
                    <th>Current Weight</th>
                    <th>Initial Body Type</th>
                    <th>Current Body Type</th>
                    <th>Progress</th>
                    <th>Service</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?=$ini_weight?></td>
                    <td><?=$curr_weight?></td>
                    <td><?=$row['ini_bodytype']?></td>
                    <td><?=$row['curr_bodytype']?></td>
                    <td><?=$progress?></td>
                    <td><?=$row['services']?></td>
                </tr>
            </tbody>
        </table>
        <div class="message-container">
            <h3><?=$row['fullname']?>'s body Structure stated as from <?=$row['ini_bodytype']?> to <?=$row['curr_bodytype']?></h3>
            <h3>With Total of <?=$progress?></h3>
            <p class="bottom"><em>Thankyou for choosing our services.<br>  -on behalf of whole team</em></p>
        </div>
    </div>
    <p class="back"><a href="member-progress-report.php">&larr;Go back</a></p>
    <?php } ?>
</div>

<?php include 'includes/footer.php'; ?>