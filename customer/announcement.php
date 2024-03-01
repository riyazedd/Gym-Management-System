<link rel="stylesheet" href="css/announcement.css">
<?php 
include '../dbcon.php';
include 'includes/boilerplate.php';

?>

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