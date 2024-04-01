<?php
include '../dbcon.php';

//Displaying Status
$sql="SELECT members.*, services.service_name 
    FROM members
    LEFT JOIN services on members.services_id=services.id";
$res=mysqli_query($conn,$sql);
$sn=1;

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FitManage Hub - Staff</title>
        <link rel="stylesheet" href="css/member-status.css">
        <script src="https://kit.fontawesome.com/426c1a4028.js" crossorigin="anonymous"></script>   
    </head>
    <body>
        
        <?php include 'includes/template.php';?>
<div class="content">
    <h2>Member's Current Status</h2>
    <div class="status-table">
        <table>
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Fullname</th>
                    <th>Contact Number</th>
                    <th>Service</th>
                    <th>Duration</th>
                    <th>D.O.R</th>
                    <th>Membership Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while($user=mysqli_fetch_assoc($res)){ ?>
                <tr>
                    <td><?=$sn++?></td>
                    <td><?=$user['fullname']?></td>
                    <td><?=$user['contact']?></td>
                    <td><?=$user['service_name']?></td>
                    <td><?=$user['plan']?> Month/s</td>
                    <td><?=$user['dor']?></td>
                    <td><?php if( $user['status'] == 'Active' || $user['status']=='active' ){ echo '<i class="fas fa-circle" style="color:green;"></i> Active';} else { echo '<i class="fas fa-circle" style="color:red;"></i> Expired';}?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>


<?php include 'includes/footer.php'?>