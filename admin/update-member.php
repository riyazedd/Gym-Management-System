<?php
include '../dbcon.php';

//Updating Information
if(isset($_GET['id'])){
    $id=$_GET['id'];
}
if(!empty($_POST)){
    $name=$_POST['fullname'];
    $username=$_POST['username'];
    $gender=$_POST['gender'];
    $dor=$_POST['dor'];
    $contact=$_POST['contact'];
    $address=$_POST['address'];
    $service=$_POST['services'];
    $duration=$_POST['plan'];
    $sql="UPDATE members SET fullname='$name', username='$username', gender='$gender', dor='$dor', contact='$contact', 
    address='$address', services_id='$service', plan='$duration' WHERE id=$id";
    if(mysqli_query($conn,$sql)){
        $_SESSION['success']="Member's Info Updated Succesfully";
        header("Location:member-list.php");
    }
}

//For Existing Info
$sql="SELECT members.*, services.service_name
    FROM members 
    LEFT JOIN services ON members.services_id = services.id
    WHERE members.id = $id";
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
                    <label for="service">Services: </label>
                    <select name="services">
                        <?php
                        // Fetching service options from the services table
                        $service_query = "SELECT * FROM services";
                        $service_result = mysqli_query($conn, $service_query);
                        while ($service = mysqli_fetch_assoc($service_result)) {
                            // Comparing each option with the value stored in the database
                            $selected = ($service['id'] == $value['services_id']) ? 'selected' : '';
                            echo "<option value='" . $service['id'] . "' $selected>" . $service['service_name'] . "</option>";
                        }
                        ?>
                    </select><br>
                    <label for="duration">Duration: </label><select name="plan">
                        <option value="1" <?php if($value['plan']=='1') echo 'selected'; ?>>One Month</option>
                        <option value="3" <?php if($value['plan']=='3') echo 'selected'; ?>>Three Month</option>
                        <option value="6" <?php if($value['plan']=='6') echo 'selected'; ?>>Six Month</option>
                        <option value="12" <?php if($value['plan']=='12') echo 'selected'; ?>>One Year</option>
                    </select>
                </div>
            <button>Update Record</button>
            </div>
        </form>
        <?php } ?>
    </div>
</div>



<?php include 'includes/footer.php'?>