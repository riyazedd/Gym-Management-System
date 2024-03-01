<?php
include '../query.php';

//Updating Progress
if(isset($_GET['id'])) $id=$_GET['id'];

// if(!empty($_POST)){
//     $ini_weight=$_POST['ini_weight'];
//     $curr_weight=$_POST['curr_weight'];
//     $ini_bodytype=$_POST['ini_bodytype'];
//     $curr_bodytype=$_POST['curr_bodytype'];
//     $sql="UPDATE members SET ini_weight='$ini_weight',curr_weight='$curr_weight',ini_bodytype='$ini_bodytype',curr_bodytype='$curr_bodytype' WHERE user_id=$id";
//     if(mysqli_query($conn,$sql)){
//         $_SESSION['success']="User Progress Updated Succesfully";
//         header('Location:member-progress.php');
//     }
// } 
if(isset($_POST['add'])){
    $obj=new query();
    $obj->update("members",$_POST,$id);
    header('Location:member-progress.php');
} 

//Displaying existing values
$sql=new query();
$res=$sql->select_id("members",$id);

while($user=mysqli_fetch_assoc($res)){
    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FitManage Hub - Admin</title>
        <link rel="stylesheet" href="css/progress-update.css">
        <script src="https://kit.fontawesome.com/426c1a4028.js" crossorigin="anonymous"></script>   
    </head>
    <body>
        
        <?php include 'includes/template.php';?>
        <div class="content">
            <h2><i class="fa-solid fa-edit" style="margin-right: 0.5rem"></i>Update Member's Progress</h2>
            <div class="form-container">
                <form action="" method="post">
                    <table>
                <tr>
                    <td><label for="name">Fullname: </label></td>
                    <td><b><?=$user['fullname']?></b></td>
                </tr>
                <tr>
                    <td><label for="service">Service Taken: </label></td>
                    <td><b><?=$user['services']?></b></td>
                </tr>
                <tr>
                    <td><label for="ini_weight">Initial Weight(in Kg): </label></td>
                    <td><input type="number" name="ini_weight" value="<?=$user['ini_weight']?>"></td>
                </tr>
                <tr>
                    <td><label for="curr_weight">Current Weight(in Kg)</label></td>
                    <td><input type="number" name="curr_weight" value="<?=$user['curr_weight']?>"></td>
                </tr>
                <tr>
                    <td><label for="ini_bodytype">Initial Body Type:</label></td>
                    <td><input type="text" name="ini_bodytype" value="<?=$user['ini_bodytype']?>"></td>
                </tr>
                <tr>
                    <td><label for="curr_bodytype">Current Body Type:</label></td>
                    <td><input type="text" name="curr_bodytype" value="<?=$user['curr_bodytype']?>"></td>
                </tr>
            </table>
            <button name='add'>Update</button>
        </form>
    </div>
</div>

<?php } include 'includes/footer.php'; ?>