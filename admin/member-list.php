<?php 
include "../dbcon.php";

//Display Users
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
        <link rel="stylesheet" href="css/member-list.css">
        <script src="https://kit.fontawesome.com/426c1a4028.js" crossorigin="anonymous"></script>   
    </head>
    <body>
    <?php include 'includes/template.php';?>

<div class="content">
    <h2>Registered Members List</h2>
    <?php if(isset($_SESSION['success'])){ ?> <div class="message"><h3><?=$_SESSION['success'];  unset($_SESSION['success'])?></h3></div><?php } ?>
    <table>
        <thead>
            <tr>
                <th>SN</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Gender</th>
                <th>Contact</th>
                <th>D.O.R</th>
                <th>Address</th>
                <th>Amount</th>
                <th>Service</th>
                <th>Duration</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($user=mysqli_fetch_assoc($res)){ ?>
            <tr>
                <td><?=$sn++?></td>
                <td><?=$user['fullname']?></td>
                <td><?=$user['username']?></td>
                <td><?=$user['gender']?></td>
                <td><?=$user['contact']?></td>
                <td><?=$user['dor']?></td>
                <td><?=$user['address']?></td>
                <td><?=$user['amount']?></td>
                <td><?=$user['services']?></td>
                <td><?=$user['plan']?> Months</td>
                <td>
                    <a href="update-member.php?id=<?=$user['id']?>" title="Update Member's Info" class="update"><i class="fa-solid fa-edit"></i></a>
                </td>
                <td>
                    <a href="member-delete.php?id=<?=$user['id']?>" title="Delete Member" class="delete"><i class="fa-solid fa-trash"></i></a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>


<?php include 'includes/footer.php'?>