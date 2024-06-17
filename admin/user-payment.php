<?php
include '../dbcon.php';

if(isset($_GET['id'])) $id=$_GET['id'];

$sql="SELECT members.*, services.service_name , services.cost
    FROM members
    LEFT JOIN services on members.services_id=services.id 
    WHERE members.id=$id";
$res=mysqli_query($conn,$sql);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
    <link rel="stylesheet" href="css/user-payment.css">
    <script src="https://kit.fontawesome.com/426c1a4028.js" crossorigin="anonymous"></script>

</head>
<body>
<?php include "includes/template.php"?>

<div class="content">
    <h2><i class="fa-solid fa-money-check-dollar" style="margin-right: 0.5rem"></i>Payment Details</h2>
    <div class="form-container">
                <form action="userpay.php" method="post">
                    <table>
                        <?php while($user=mysqli_fetch_assoc($res)){ ?>
                    <tr>
                        <td><label for="name">Fullname: </label></td>
                        <td><input type="hidden" name="fullname" value="<?=$user['fullname']?>"><b><?=$user['fullname']?></b></td>
                    </tr>
                    <tr>
                        <td><label for="service">Service Taken: </label></td>
                        <td><input type="hidden" name="services" value="<?=$user['services_id'] ?>"><b><?=$user['service_name']?></b></td>
                    </tr>
                    <tr>
                        <td><label for="amount">Amount per Month</label></td>
                        <td><input type="number" name="amount" value="<?=$user['cost']?>"></td>
                    </tr>
                    <tr>
                        <td><label for="plan">Plan</label></td>
                        <td><input type="number" name="plan" value="<?=$user['plan']?>"></td>
                    </tr>
                    <tr>
                        <td><label for="total">Total</label></td>
                        <td><input type="number" name="total" value="<?=$user['cost']*$user['plan']?>"></td>
                    </tr>
                </table>
                <input type="hidden" name="id" value="<?=$user['id']?>"> 
                <button>Make Payment</button>
                <?php } ?>
        </form>
    </div>
</div>



<?php include "includes/footer.php" ?>