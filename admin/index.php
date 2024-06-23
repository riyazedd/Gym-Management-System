<?php 
include '../dbcon.php';
if(!empty($_POST)){
    $username=$_POST['username'];
    $password=md5($_POST['password']);
    $sql="SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result=mysqli_query($conn,$sql);
    $user=mysqli_fetch_assoc($result);
    $num_rows=mysqli_num_rows($result);
    if($num_rows>0){
        $_SESSION['user']=$user['username'];
        $_SESSION['uid']=$user['id'];
        $_SESSION['is_login']=true;
        $_SESSION['role']='admin';
        header("Location: dashboard.php");
    }
    else{
        $_SESSION['error']="Incorrect Username or Password";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="./css/login.css">
    <script src="https://kit.fontawesome.com/426c1a4028.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <h1>Admin Login</h1>
        <div class="form-container">
            <p style="color: #EE4266">
            <?php
            if(isset($_SESSION['error'])){
                echo $_SESSION['error'];
                unset($_SESSION['error']);
            } 
            ?></p>
            <form action="" method="post">
                <div class="input"><span><i class="fa-solid fa-at"></i></span><input type="text" name="username" placeholder="Username" required></div>
                <div class="input"><i class="fa-solid fa-lock"></i><input type="password" name="password" placeholder="Password" required></div>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
</body>
</html>