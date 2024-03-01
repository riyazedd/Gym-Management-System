<?php include '../dbcon.php';
session_start();

if(!$_SESSION['is_login']){
    echo "login or signup first";
    header("Location:./login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitManage Hub</title>
    <script src="https://kit.fontawesome.com/426c1a4028.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/boilerplate.css">
</head>
<body>
    <div class="container">
    <div class="sidebar">
            <div class="logo"><img src="../images/logo.png" alt=""></div>

            <div class="options">
                <ul>
                    <li><a href="dashboard.php" class="pages"><span class="icon"><i class="fa-solid fa-house"></i></span>Dashboard</a></li>
                    <li><a href="todo.php" class="pages"><span class="icon"><i class="fa-solid fa-pencil"></i></span>To-Do</a></li>
                    <li><a href="reminder.php" class="pages"><span class="icon"><i class="fa-solid fa-clock"></i></span>Reminders</a></li>
                    <li><a href="announcement.php" class="pages"><span class="icon"><i class="fa-solid fa-bullhorn"></i></span>Announcements</a></li>
                    <li><a href="reports.php" class="pages"><span class="icon"><i class="fa-solid fa-file"></i></span>Reports</a></li>
                </ul>
            </div>
        </div>
        <div class="section">
            <div class="header">
                <ul>
                    <li class="dropdown"><a href="#"><span class="icon"><i class="fa-solid fa-user"></i></span>Welcome <?=$_SESSION['user']?></a>
                    <ul>
                        <li><a href="">My Tasks</a></li>
                        <li><a href="">My Reports</a></li>
                    </ul></li>
                    <li><a href="../logout.php"><span class="icon"><i class="fa-solid fa-right-from-bracket"></i></span>Logout</a></li>
                </ul>
            </div>
            
 