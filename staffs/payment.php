<?php
include '../dbcon.php';
include "includes/authentication.php";

$trainer_id = $_SESSION['uid'];


//Displaying Members
$sql="SELECT members.*, services.service_name , services.cost
    FROM members
    LEFT JOIN services on members.services_id=services.id
        WHERE members.trainer_id = $trainer_id";

//Search Users
if (!empty($_POST)) {
    $search = $_POST['search'];
    if (!empty($search)) {
        $sql .= " AND (CONCAT(members.fullname, services.service_name, status) LIKE '%$search%')";
    }
}

$res=mysqli_query($conn,$sql);
$sn=1;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="css/payment.css">
    <script src="https://kit.fontawesome.com/426c1a4028.js" crossorigin="anonymous"></script>
    <script>
        // JavaScript function to submit form only when input field is cleared
        function submitForm() {
            var searchValue = document.getElementById("searchField").value.trim();
            if (searchValue === '') {
                document.getElementById("searchForm").submit();
            }
        }
    </script>
</head>
<body>
    <?php include "includes/template.php"?>
    <div class="content">
        <div class="heading">
        <h2><i class="fa-solid fa-money-check-dollar"></i>User Payment</h2>
        <form action="payment.php" method="post" id="searchForm">
                <input type="text" id="searchField" placeholder="Search" name="search"
                    value="<?php echo isset($_POST['search']) ? htmlspecialchars($_POST['search']) : ''; ?>"
                    oninput="submitForm()">
                <button type="submit"><i class="fa-solid fa-search"></i></button>
            </form>
        </div>
        <?php if(isset($_SESSION['success'])){ ?> <div class="message"><h3><?=$_SESSION['success'];  unset($_SESSION['success'])?></h3></div><?php } ?>
        <div class="pay-table">
            <table>
                <thead>
                <tr>
                    <th>S.N</th>
                    <th>Fullname</th>
                    <th>Last Payment Date</th>
                    <th>Amount</th>
                    <th>Choosen Service</th>
                    <th>Plan</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th>Remind</th>
                </tr>
                </thead>
                <tbody>
                    <?php while($user=mysqli_fetch_assoc($res)) { ?>
                    <tr>
                        <td><?=$sn++?></td>
                        <td><?=$user['fullname']?></td>
                        <td><?=$user['pay_date']?></td>
                        <td><?=$user['cost']?></td>
                        <td><?=$user['service_name']?></td>
                        <td><?=$user['plan']?> Month/s</td>
                        <td><?php if( $user['status'] == 'Active' || $user['status']=='active' ){ echo '<i class="fas fa-circle" style="color:green;"></i> Active';} else { echo '<i class="fas fa-circle" style="color:red;"></i> Expired';}?></td>                
                        <td>
                            <a href="user-payment.php?id=<?php echo $user['id']?>"><button class="pay">Make Payment</button></a>
                        </td>
                        <td>
                            <a href="sendReminder.php?id=<?php echo $user['id']?>"><button class="alert">Send Alert</button></a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>


<?php include "includes/footer.php" ?>