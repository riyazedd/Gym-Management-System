<?php 
include '../dbcon.php';

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FitManage Hub</title>
        <script src="https://kit.fontawesome.com/426c1a4028.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="./css/boilerplate.css">
        <link rel="stylesheet" href="css/announcement.css">
    </head>
    <body>
        
      <?php  include 'includes/boilerplate.php';?>
<div class="content">
    <h2>Announcements</h2>
    <div class="announcements">
        <?php
            $sql="SELECT * FROM announcements";
            $result=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_assoc($result)){
            ?>
                <div class="announce">
                    <span class="ann"><i class="fa-solid fa-bullhorn"></i></span>
                    <div class="message">
                        <p class="announcer">By: System Administrator / Date: <?=$row['date']?></p>
                        <h3><?=$row['message']?></h3>
                    </div>
                </div>
                
            <?php
            }
        ?>
    </div>
</div>




<?php include 'includes/footer.php'?>