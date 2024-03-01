<?php
include '../dbcon.php';

//Displaying Equipment List
$sql="SELECT * FROM equipment";
$res=mysqli_query($conn,$sql);
$sn=1;


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FitManage Hub - Admin</title>
        <link rel="stylesheet" href="css/equipment-list.css">
        <script src="https://kit.fontawesome.com/426c1a4028.js" crossorigin="anonymous"></script>   
    </head>
    <body>
    <?php include 'includes/template.php';?>

<div class="content">
    <h2>Gym's Equipment List</h2>
    <?php if(isset($_SESSION['success'])){ ?> <div class="message"><h3><?=$_SESSION['success'];  unset($_SESSION['success'])?></h3></div><?php } ?>
    <table>
        <thead>
            <tr>
                <th>SN</th>
                <th>Name</th>
                <th>Description</th>
                <th>Qty</th>
                <th>Price/pcs</th>
                <th>Total Price</th>
                <th>Vendor</th>
                <th>Contact</th>
                <th>Purchased Date</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($item=mysqli_fetch_assoc($res)) { ?>
            <tr>
                <td><?=$sn++?></td>
                <td><?=$item['name']?></td>
                <td><?=$item['description']?></td>
                <td><?=$item['quantity']?></td>
                <td><?=$item['amount']?></td>
                <td><?=$item['total_amount']?></td>
                <td><?=$item['vendor']?></td>
                <td><?=$item['contact']?></td>
                <td><?=$item['date']?></td>
                <td><a href="equipment-update.php?id=<?=$item['id']?>" class="update" title="Update Equipment Information"><i class="fa-solid fa-edit"></i></a></td>
                <td><a href="equipment-delete.php?id=<?=$item['id']?>" class="delete" title="Remove Equipment"><i class="fa-solid fa-trash"></i></a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php';?>