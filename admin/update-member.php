<?php
include '../dbcon.php';
include '../query.php';
//Updating Information
if(isset($_GET['id'])){
    $id=$_GET['id'];
}
if(isset($_POST['add'])){
    // $name=$_POST['fullname'];
    // $username=$_POST['username'];
    // $gender=$_POST['gender'];
    // $dor=$_POST['dor'];
    // $contact=$_POST['contact'];
    // $address=$_POST['address'];
    // $service=$_POST['services'];
    // $duration=$_POST['plan'];
    // $sql="UPDATE members SET fullname='$name', username='$username', gender='$gender', dor='$dor', contact='$contact', 
    // address='$address', services='$service', plan='$duration' WHERE user_id=$id";
    // if(mysqli_query($conn,$sql)){
    //     $_SESSION['success']="Member's Info Updated Succesfully";
    //     header("Location:member-list.php");
    // }
        $obj=new query();
        $obj->update("members",$_POST,$id);
        header('Location:member-list.php');

}

//For Existing Info
$sql="SELECT * FROM members WHERE id=$id";
$res=mysqli_query($conn,$sql);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FitManage Hub - Admin</title>
        <link rel="stylesheet" href="css/update-member.css">
        <script src="https://kit.fontawesome.com/426c1a4028.js" crossorigin="anonymous"></script>   
    </head>
    <body>
    <?php include 'includes/template.php'; ?>
<div class="content">
    <h2>Update Member's Information</h2>
    <div class="form-container">
        <?php while($value=mysqli_fetch_assoc($res)) { ?>
        <form action="" method="post">
            <div class="personal">
                <h3>Personal-Info</h3>
                <label for="fullname">Full Name: </label><input type="text" name="fullname" value="<?=$value['fullname']?>"><br>
                <label for="username">Username: </label><input type="text" name="username" value="<?=$value['username']?>"><br>
                <label for="gender">Gender: </label>
                <select name="gender">
                    <option value="male" <?php if($value['gender']=='male') echo 'selected'; ?>>Male</option>
                    <option value="female" <?php if($value['gender']=='female') echo 'selected'; ?>>Female</option>
                    <option value="other" <?php if($value['gender']=='others') echo 'selected'; ?> >Others</option>
                </select><br>
                <label for="dor">D.O.R: </label><input type="date" name="dor" value="<?=$value['dor']?>">
            </div>
            <div class="other">
                <div class="contact">
                    <h3>Contact Details</h3>
                    <label for="contact">Contact Number: </label><input type="text" name="contact" value="<?=$value['contact']?>"><br>
                    <label for="address">Address: </label><input type="text" name="address" value="<?=$value['address']?>"><br>
                </div>
                <hr>
                <div class="service">
                    <h3>Service Details</h3>
                    <label for="service">Services: </label><select name="services">
                        <option value="Fitness" <?php if($value['services']=='fitness') echo 'selected'; ?>>Fitness</option>
                        <option value="Sauna" <?php if($value['services']=='sauna') echo 'selected'; ?>>Sauna</option>
                        <option value="Cardio" <?php if($value['services']=='cardio') echo 'selected'; ?>>Cardio</option>
                    </select><br>
                    <label for="duration">Duration: </label><select name="plan">
                        <option value="1" <?php if($value['plan']=='1') echo 'selected'; ?>>One Month</option>
                        <option value="3" <?php if($value['plan']=='3') echo 'selected'; ?>>Three Month</option>
                        <option value="6" <?php if($value['plan']=='6') echo 'selected'; ?>>Six Month</option>
                        <option value="12" <?php if($value['plan']=='12') echo 'selected'; ?>>One Year</option>
                    </select>
                </div>
            <button name="add">Update Record</button>
            </div>
        </form>
        <?php } ?>
    </div>
</div>



<?php include 'includes/footer.php'?>