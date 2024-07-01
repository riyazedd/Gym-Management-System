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
    $select_sql="SELECT members.*, services.service_name , services.cost
        FROM members
        LEFT JOIN services on members.services_id=services.id 
        WHERE members.id=$id";
    $select_res=mysqli_query($conn,$select_sql);
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt</title>
    <link rel="stylesheet" href="css/userpay.css">
    <script src="https://kit.fontawesome.com/426c1a4028.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php include 'includes/template.php'?>

<div class="content">
    <h2><i class="fa-solid fa-receipt" style="margin-right:0.5rem"></i>Payment Receipt</h2>
    <div class="receipt-container">
        <table>
            <thead>
                <tr>
                    <th colspan="2">FitManage Hub</th>
                </tr>
            </thead>
            <tbody>
                <?php while($user=mysqli_fetch_assoc($select_res)){ ?>
                <tr>
                    <td>Date: <?=$date?> </td>
                </tr>
                <tr>
                    <td>Fullname</td>
                    <td><?=$user['fullname']?></td>
                </tr>
                <tr>
                    <td>Contact</td>
                    <td><?=$user['contact']?></td>
                </tr>
                <tr>
                    <td>Service Taken</td>
                    <td><?=$user['service_name']?></td>
                </tr>
                <tr>
                    <td>Amount per Month</td>
                    <td><?=$user['cost']?></td>
                </tr>
                <tr>
                    <td>Duration</td>
                    <td><?=$user['plan']?></td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td><?=$user['cost']*$user['plan']?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="message-container">
            <h2 class="message-text">Payment Succesfull!!</h2>
            <p>Thankyou for choosing us!</p>
            <p>We sincerely appreciate your promptness regarding all payments from your side.</p>
        </div>
        <form>
            <input type="button" value="Print this page" onClick="window.print()">
        </form>
    </div>
</div>


    <?php include 'includes/footer.php'?>