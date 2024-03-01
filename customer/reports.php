<link rel="stylesheet" href="css/reports.css">
<?php 
include '../dbcon.php';
include 'includes/boilerplate.php';

//FOR PROGRESS
$id=$_SESSION['uid'];
$sql="SELECT * FROM members WHERE user_id=$id";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_assoc($result)){
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
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?=$ini_weight?></td>
                    <td><?=$curr_weight?></td>
                    <td><?=$row['ini_bodytype']?></td>
                    <td><?=$row['curr_bodytype']?></td>
                    <td><?=$progress?></td>
                </tr>
            </tbody>
        </table>
        <div class="message-container">
            <h3>Dear <?=$row['fullname']?>,</h3>
            <h3>Congratulations on your achievement!</h3>
            <p><em>Thankyou for choosing our services.<br>  -on behalf of whole team</em></p>
        </div>
    </div>
    <h2>Membership Report</h2>
    <div class="membership">
        <div class="gym-info">
            <h3>FitManage Hub</h3>
            <p>Kathmandu, Nepal <br>Tel: 9876543210 <br>support@fitmanage.com</p>
        </div>
        <div class="details">
            <div class="top">
                <table>
                    <thead>
                        <tr>
                            <th>Member ID</th>
                            <th>Service Taken</th>
                            <th>Duration</th>
                            <th>Address</th>
                            <th>Charge</th>
                            <th>Attendance Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?=$id?></td>
                            <td><?=$row['services']?></td>
                            <td><?=$row['plan']?> Month/s</td>
                            <td><?=$row['address']?></td>
                            <td><?=$row['amount']?></td>
                            <td><?=$row['attendance_count']?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="bottom">
                <h3>Last Payment Done: $<?=$row['amount']?>/-</h3>
                <p>Member Since: <?=$row['dor']?></p>
            </div>
        </div>
        <div class="membership-message">
            <h3>Dear <?=$row['fullname']?>,</h3><br>
            <h3>Your Membership is currently <?=$row['status']?></h3>
            <p><em>Thankyou for choosing our services.<br>  -on behalf of whole team</em></p>
        </div>
    </div>
</div>
<?php } ?>

<?php include 'includes/footer.php'?>