<?php
include '../query.php';

if(isset($_GET['id'])) $id=$_GET['id'];

//Update Staff Information
if(isset($_POST['add'])){
    $obj=new query();
    $obj->update("staffs",$_POST,$id);
    header('Location:staff-manage.php');
}

//Display Existing Values
$val=new query();
$res=$val->select_id("staffs",$id);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FitManage Hub - Admin</title>
        <link rel="stylesheet" href="css/staff-update.css">
    <script src="https://kit.fontawesome.com/426c1a4028.js" crossorigin="anonymous"></script>   
</head>
<body>

<?php include 'includes/template.php';?>
<div class="content">
    <h2><i class="fa-solid fa-edit" style="margin-right: 0.5rem"></i>Update Staff's Information</h2>
    <div class="form-container">
        <?php foreach($res as $value) { ?>
        <form action="" method="post">
            <div class="left">
                <label for="fullname">Enter Fullname</label>
                <input type="text" name="fullname" value="<?=$value['fullname']?>">
                <label for="username">Enter Username</label>
                <input type="text" name="username" value="<?=$value['username']?>">
                <label for="gender">Gender</label>
                <select name="gender">
                    <option value="Male" <?php if($value=="Male") echo "selected";?> >Male</option>
                    <option value="Female" <?php if($value=="Female") echo "selected";?>>Female</option>
                    <option value="Others" <?php if($value=="Others") echo "selected";?>>Others</option>
                </select>
                <label for="email">Email</label>
                <input type="email" name="email" value="<?=$value['email']?>">
            </div>
            <div class="right">
                <label for="contact">Contact</label>
                <input type="text" name="contact" value="<?=$value['contact']?>">
                <label for="address">Address</label>
                <input type="text" name="address" value="<?=$value['address']?>">
                <label for="designation">Designation</label>
                <select name="designation">
                    <option value="Cashier" <?php if($value=="Cashier") echo "selected";?>>Cashier</option>
                    <option value="Trainer" <?php if($value=="Trainer") echo "selected";?>>Trainer</option>
                    <option value="Gym Assistant" <?php if($value=="Gym Assistant") echo "selected";?>>Gym Assistant</option>
                    <option value="Front Desk Officer" <?php if($value=="Front Desk Officer") echo "selected";?>>Front Desk Officer</option>
                    <option value="Manager" <?php if($value=="Manager") echo "selected";?>>Manager</option>
                </select>
                <button name="add">Update Staff</button>
            </div>
        </form>
        <?php } ?>
        <p class="back"><a href="staff-manage.php">&larr;Go back</a></p>
    </div>
</div>

<?php include 'includes/footer.php'; ?>