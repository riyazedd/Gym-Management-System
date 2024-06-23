<?php
include '../dbcon.php';
include 'includes/authentication.php';

if(isset($_GET['id'])){
    $id=$_GET['id'];
}

if(!empty($_POST)){
    $task=$_POST['task'];
    $status=$_POST['status'];
    $user_id=$_POST['user_id'];
    $sql="UPDATE todo SET task_status='$status', task_desc='$task' WHERE id='$id'";
    $result=mysqli_query($conn,$sql);
    if($result){
        $_SESSION['success']="Task Updated Successfully";
        header("Location:dashboard.php");
    }else{
        $_SESSOIN['error']="Error Adding Task";
    }
}

//Viewing existing values
$sql="SELECT * FROM todo WHERE id='$id'";
$result=mysqli_query($conn,$sql);

foreach($result as $key=>$value){
    
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
      <?php  include 'includes/boilerplate.php';?>
        <div class="content">
            <h2>Update Task</h2>
            <div class="form-container">
    <form action="" method="post">
        <div class="input">
            <label for="task">Please Enter your Task: </label>
            <input type="text" name="task" value="<?=$value['task_desc']?>">
        </div>
        <div class="input">
            <label for="task">Please Select a Status: </label>
            <select name="status">
                <option value="In Progress" <?php if($value['task_status']=="In Progress"){echo "selected";}?>>In Progress</option>
                <option value="Pending" <?php if($value['task_status']=="Pending"){echo "selected";}?>>Pending</option>
            </select>
        </div>
        <input type="hidden" name="id" value="<?=$_SESSION['uid']?>">
        <button>Update</button>
        <?php 
}
            if(isset($_SESSION['success'])){
                echo $_SESSION['success'];
                unset($_SESSION['success']);
            }
        ?>
    </form>
    </div>
</div>


<?php include 'includes/footer.php'?>