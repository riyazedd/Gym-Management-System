<?php
include '../query.php';

//Displaying Staff List
$sql=new query();
$res=$sql->select("staffs");
$sn=1;

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FitManage Hub - Admin</title>
        <link rel="stylesheet" href="css/staff-manage.css">
        <script src="https://kit.fontawesome.com/426c1a4028.js" crossorigin="anonymous"></script>   
    </head>
    <body>
        
        <?php include 'includes/template.php'; ?>
<div class="content">
    <h2><i class="fa-solid fa-list" style="margin-right: 0.5rem"></i>Staff List</h2>
    <?php if(isset($_SESSION['success'])){ ?> <div class="message"><h3><?=$_SESSION['success'];  unset($_SESSION['success'])?></h3></div><?php } ?>
    <hr>
    <a href="staff-add.php"><button class="add">Add Staff Members</button></a>
    <table>
        <thead>
            <tr>
                <th>SN</th>
                <th>Fullname</th>
                <th>Username</th>
                <th>Gender</th>
                <th>Designation</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Address</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($staff=mysqli_fetch_assoc($res)) { ?>
            <tr>
                <td><?=$sn++?></td>
                <td><?=$staff['fullname']?></td>
                <td><?=$staff['username']?></td>
                <td><?=$staff['gender']?></td>
                <td><?=$staff['designation']?></td>
                <td><?=$staff['email']?></td>
                <td><?=$staff['contact']?></td>
                <td><?=$staff['address']?></td>
                <td><a href="staff-update.php?id=<?=$staff['id']?>" class="update" title="Edit Staff Information"><i class="fa-solid fa-edit"></i></a></td>
                <td><a href="staff-delete.php?id=<?=$staff['id']?>" class="delete" title="Delete Staff"><i class="fa-solid fa-trash"></i></a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>


<?php include 'includes/footer.php'; ?>