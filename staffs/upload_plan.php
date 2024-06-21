<?php
require_once "../dbcon.php";

if(isset($_GET['id'])){
    $id=$_GET['id'];
}

if(!empty($_POST)){
    $link=$_POST['link'];
    $sql="UPDATE members SET plan_link='$link' WHERE id=$id";
    $res=mysqli_query($conn,$sql);
    if($res){
        $_SESSION['success']="Training Plan Added";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Training Plan</title>
    <link rel="stylesheet" href="css/member-progress.css">
    <script src="https://kit.fontawesome.com/426c1a4028.js" crossorigin="anonymous"></script>
</head>
<body>
<?php include 'includes/template.php'; ?>

<div class="content">
    <h1>Upload Training Plan</h1>
    <form action="" method="post" class="plan">
        <label for="link">Add Training Plan Link</label>
        <input type="text" name="link" placeholder="Add Plan Link">
        <button class="add">Add</button>
    </form>
</div>


<?php include 'includes/footer.php' ?>