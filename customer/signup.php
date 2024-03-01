<?php
include "../dbcon.php";
session_start();
if(!empty($_POST)){
    $fname=$_POST['fullname'];
    $username=$_POST['username'];
    $password=md5($_POST['password']);
    $contact=$_POST['contact'];
    $address=$_POST['address'];
    $gender=$_POST['gender'];
    $plan=$_POST['plan'];
    $services=$_POST['services'];
    $dor=date("Y-m-d");
    $sql="INSERT INTO members (fullname,username,password,contact,address,gender,plan,services,dor) VALUES
    ('$fname','$username','$password','$contact','$address','$gender','$plan','$services','$dor')";
    $result=mysqli_query($conn,$sql);
    if($result){
        $_SESSION['success']="Registered Succesfully";
    }else{
        $_SESSION['error']="Error Registering User";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Sign Up</title>
    <link rel="stylesheet" href="./css/signup.css">
    <script src="https://kit.fontawesome.com/426c1a4028.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <h1>Customer Sign Up</h1>
        <p><?php 
            if(isset($_SESSION['success'])){
                echo $_SESSION['success'];
                unset ($_SESSION['success']);
            }
            if(isset($_SESSION['error'])){
                echo $_SESSION['error'];
                unset($_SESSION['error']);
            }
        ?></p>
        <div class="form-container">
            <form action="" method="post">
                <div class="input-container">
                <div class="input"><i class="fa-solid fa-user"></i><input type="text" name="fullname" placeholder="Full Name" required></div>
                <div class="input"><i class="fa-solid fa-at"></i><input type="text" name="username" placeholder="Username" required></div>
                <div class="input"><i class="fa-solid fa-lock"></i><input type="password" name="password" placeholder="Password" required></div>
                <div class="input"><i class="fa-solid fa-phone"></i><input type="text" name="contact" placeholder="Contact Number" required></div>
                <div class="input"><i class="fa-solid fa-location-dot"></i><input type="text" name="address" placeholder="Address" required></div>
                <div class="input"><i class="fa-solid fa-venus-mars"></i>
                    <select name="gender" required>
                    <option selected disabled hidden value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="others">Others</option>
                </select></div>
                <div class="input"><i class="fa-solid fa-hourglass"></i>
                    <select name="plan" required>
                    <option selected disabled hidden value="">Select Plan</option>
                    <option value="1">One Month</option>
                    <option value="3">Three Months</option>
                    <option value="6">Six Months</option>
                    <option value="12">One Year</option>
                </select></div>
                <div class="input"><i class="fa-solid fa-magnifying-glass"></i>
                <select name="services" required>
                    <option selected disabled hidden value="">Select Service</option>
                    <option value="Fitness">Fitness</option>
                    <option value="Sauna">Sauna</option>
                    <option value="Cardio">Cardio</option>  
                </select></div>
                </div>
                <div class="action">
            <a href="login.php">Login</a>
            <button>Submit Details</button>
        </div>
            </form>
        </div>
        
    </div>
</body>
</html>