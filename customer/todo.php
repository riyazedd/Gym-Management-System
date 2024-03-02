<?php
include '../dbcon.php';

if(!empty($_POST)){
    $task=$_POST['task'];
    $status=$_POST['status'];
    $user_id=$_POST['id'];
    $sql="INSERT INTO todo (task_status,task_desc,user_id)VALUES('$status','$task','$user_id')";
    $result=mysqli_query($conn,$sql);
    if($result){
        $_SESSION['success']="Task Added Successfully";
    }else{
        $_SESSOIN['error']="Error Adding Task";
    }
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
        <link rel="stylesheet" href="css/todo.css">
    </head>
    <body>
   <?php include 'includes/boilerplate.php';?>

<div class="content">
    <h2>To-Do Lists</h2>
    <div class="form-container">
    <form action="" method="post">
        <div class="input">
            <label for="task">Please Enter your Task: </label>
            <input type="text" name="task">
        </div>
        <div class="input">
            <label for="task">Please Select a Status: </label>
            <select name="status">
                <option value="In Progress">In Progress</option>
                <option value="Pending">Pending</option>
            </select>
        </div>
        <input type="hidden" name="id" value="<?=$_SESSION['uid']?>">
        <button>Add To List</button>
        <?php 
            if(isset($_SESSION['success'])){
                echo $_SESSION['success'];
                unset($_SESSION['success']);
            }
        ?>
    </form>
    </div>
</div>


<?php include 'includes/footer.php'?>