<link rel="stylesheet" href="css/reminder.css">
<?php 
include "../dbcon.php";
include "includes/boilerplate.php";
?>

<div class="content">
    <h2>Reminders</h2>
    <?php 
        $id=$_SESSION['uid'];
        $sql="SELECT reminder FROM members WHERE user_id=$id";
        $result=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result)){
            if($row['reminder']=='1'){ 
            ?>
                <div class="message">
                    <h3>Alert</h3>
                <p>This is to notify you that your current membership program is going to expire soon. Please clear up your payments before your due dates. <br>IT IS IMPORTANT THAT YOU CLEAR YOUR DUES ON TIME IN ORDER TO AVOID SERVICE DISRUPTIONS.</p>
                <hr>
                <p class="mb-0">We value you as our customer and look forward to continue serving you in the future.</p>
                </div>
            <?php
            }
            else{
            ?>
                <div class="no-remind">
                    <h3>NO REMINDER YET!</h3>
                </div>
                <?php
            }
        }
    
    ?>
    
</div>


<?php include "includes/footer.php"?>