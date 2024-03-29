<?php
include '../dbcon.php';

//Updating Progress
if(isset($_GET['id'])) $id=$_GET['id'];

if(!empty($_POST)){
    $ini_weight=$_POST['ini_weight'];
    $curr_weight=$_POST['curr_weight'];
    $ini_bodytype=$_POST['ini_bodytype'];
    $curr_bodytype=$_POST['curr_bodytype'];
    $sql="UPDATE progress SET ini_weight='$ini_weight',curr_weight='$curr_weight',ini_bodytype='$ini_bodytype',curr_bodytype='$curr_bodytype' WHERE member_id=$id";
    if(mysqli_query($conn,$sql)){
        $_SESSION['success']="User Progress Updated Succesfully";
        header('Location:member-progress.php');
    }
}  

//Displaying existing values

$sql = "SELECT members.*,services.service_name, progress.ini_weight, progress.curr_weight, progress.ini_bodytype, progress.curr_bodytype
        FROM members
        LEFT JOIN progress ON members.id = progress.member_id
        LEFT JOIN services ON members.services_id = services.id
        WHERE members.id = $id";

$res = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($res)) {
    // Displaying values
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
                        <td><b><?= $row['fullname'] ?></b></td>
                    </tr>
                    <tr>
                        <td><label for="service">Service Taken: </label></td>
                        <td><b><?= $row['service_name'] ?></b></td>
                    </tr>
                    <tr>
                        <td><label for="ini_weight">Initial Weight(in Kg): </label></td>
                        <td><input type="number" name="ini_weight" value="<?= $row['ini_weight'] ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="curr_weight">Current Weight(in Kg)</label></td>
                        <td><input type="number" name="curr_weight" value="<?= $row['curr_weight'] ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="ini_bodytype">Initial Body Type:</label></td>
                        <td><input type="text" name="ini_bodytype" value="<?= $row['ini_bodytype'] ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="curr_bodytype">Current Body Type:</label></td>
                        <td><input type="text" name="curr_bodytype" value="<?= $row['curr_bodytype'] ?>"></td>
                    </tr>
            </table>
            <button>Update</button>
        </form>
    </div>
</div>

<?php } include 'includes/footer.php'; ?>