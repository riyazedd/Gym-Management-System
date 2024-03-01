<?php
include '../query.php';

//Adding/Inserting Announcements
if(isset($_POST['add'])){
    $obj=new query();
    $obj->insert("announcements",$_POST);
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FitManage Hub - Admin</title>
        <link rel="stylesheet" href="css/announcement-add.css">
        <script src="https://kit.fontawesome.com/426c1a4028.js" crossorigin="anonymous"></script>   
    </head>
    <body>
   <?php include 'includes/template.php';?>

<div class="content">
    <h2><i class="fa-solid fa-bullhorn" style="margin-right: 0.5rem"></i>Announcements</h2>
    <?php if(isset($_SESSION['success'])){ ?> <div class="message"><h3><?=$_SESSION['success'];  unset($_SESSION['success'])?></h3></div><?php } ?>
    <hr>
    <a href="announcement-manage.php"><button class="manage">Manage Your Announcements</button></a>
    <div class="form-container">
        <form action="" method="post">
            <table>
                <thead>
                    <tr>
                        <th><h3>Make Announcement</h3></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <textarea name="message" placeholder="Enter announcement here..."></textarea><br>
                            <label for="date">Date:&nbsp&nbsp</label><input type="date" name="date"><br>
                            <button name='add' class="publish">Publish</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>