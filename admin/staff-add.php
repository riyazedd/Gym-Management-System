<?php
include '../query.php';

//USING OOPS
if(isset($_POST['add'])){
    $obj=new query();
    $res=$obj->insert("staffs",$_POST);
    if($res){
        $_SESSION['success']="New Staff Added";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FitManage Hub - Admin</title>
        <link rel="stylesheet" href="css/staff-add.css">
        <script src="https://kit.fontawesome.com/426c1a4028.js" crossorigin="anonymous"></script>   
    </head>
    <body>
        
       <?php include 'includes/template.php';?>
<div class="content">
    <h2><i class="fa-solid fa-edit" style="margin-right: 0.5rem"></i>Staff Registration Form</h2>
    <?php if(isset($_SESSION['success'])){ ?> <div class="message"><h3><?=$_SESSION['success'];  unset($_SESSION['success'])?></h3></div><?php } ?>
    <div class="form-container">
        <form action="" method="post">
            <div class="left">
                <label for="fullname">Enter Fullname</label>
                <input type="text" name="fullname">
                <label for="username">Enter Username</label>
                <input type="text" name="username">
                <label for="password">Password</label>
                <input type="password" name="password">
                <label for="gender">Gender</label>
                <select name="gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Others">Others</option>
                </select>
            </div>
            <div class="right">
                <label for="email">Email</label>
                <input type="email" name="email">
                <label for="contact">Contact</label>
                <input type="text" name="contact">
                <label for="address">Address</label>
                <input type="text" name="address">
                <label for="designation">Designation</label>
                <select name="designation">
                    <option value="Cashier">Cashier</option>
                    <option value="Trainer">Trainer</option>
                    <option value="Gym Assistant">Gym Assistant</option>
                    <option value="Front Desk Officer">Front Desk Officer</option>
                    <option value="Manager">Manager</option>
                </select>
                <button name="add">Add Staff</button>
            </div>
        </form>
        <p class="back"><a href="staff-manage.php">&larr;Go back</a></p>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
