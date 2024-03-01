<?php 
include '../query.php';

if(isset($_POST['add'])){
    $obj=new query();
    $obj->insert("members",$_POST);
    $_SESSION['success']="Added Successfully";
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FitManage Hub - Admin</title>
        <link rel="stylesheet" href="css/member-registration.css">
        <script src="https://kit.fontawesome.com/426c1a4028.js" crossorigin="anonymous"></script>   
    </head>
    <body>
        
       <?php include 'includes/template.php';?>
<div class="content">
<h2>New Member Register Form</h2>
<?php if(isset($_SESSION['success'])){ ?> <div class="message"><h3><?=$_SESSION['success'];  unset($_SESSION['success'])?></h3></div><?php } ?>
    <div class="form-container">
        <form action="" method="post">
            <div class="personal">
                <h3>Personal-Info</h3>
                <label for="fullname">Full Name: </label><input type="text" name="fullname"><br>
                <label for="username">Username: </label><input type="text" name="username"><br>
                <label for="password">Password: </label><input type="text" name="password"><br>
                <label for="gender">Gender: </label>
                <select name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Others</option>
                </select><br>
                <label for="dor">D.O.R: </label><input type="date" name="dor">
            </div>
            <div class="other">
                <div class="contact">
                    <h3>Contact Details</h3>
                    <label for="contact">Contact Number: </label><input type="text" name="contact"><br>
                    <label for="address">Address: </label><input type="text" name="address"><br>
                </div>
                <hr>
                <div class="service">
                    <h3>Service Details</h3>
                    <label for="service">Services: </label><select name="services">
                        <option value="Fitness">Fitness</option>
                        <option value="Sauna">Sauna</option>
                        <option value="Cardio">Cardio</option>
                    </select><br>
                    <label for="duration">Duration: </label><select name="plan">
                        <option value="1">One Month</option>
                        <option value="3">Three Month</option>
                        <option value="6">Six Month</option>
                        <option value="12" >One Year</option>
                    </select>
                </div>
            <button name='add'>Register Member</button>
            </div>
        </form>
    </div>
</div>

<?php include 'includes/footer.php' ?>