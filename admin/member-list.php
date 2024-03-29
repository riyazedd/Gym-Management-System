<?php 
include "../dbcon.php";

//Display Users
$sql="SELECT members.*, services.service_name, services.cost
    FROM members
    LEFT JOIN services on members.services_id=services.id";
$res=mysqli_query($conn,$sql);
$sn=1;

//Searching Users 
if(!empty($_POST)){
    $search=$_POST['search'];
    if(!empty($search)){
        $sql="SELECT members.*, services.service_name, services.cost
        FROM members
        LEFT JOIN services on members.services_id=services.id WHERE CONCAT(fullname,service_name    ) LIKE '%$search%'";
        $res=mysqli_query($conn,$sql);
    }else{
        $sql="SELECT members.*, services.service_name, services.cost
        FROM members
        LEFT JOIN services on members.services_id=services.id";
        $res=mysqli_query($conn,$sql);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FitManage Hub - Admin</title>
        <link rel="stylesheet" href="css/member-list.css">
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
    <?php include 'includes/template.php';?>

<div class="content">
    <div class="heading"><h2>Registered Members List</h2>
    <form action="member-list.php" method="post" id="searchForm">
        <input type="text" id="searchField" placeholder="Search" name="search" value="<?php echo isset($_POST['search']) ? htmlspecialchars($_POST['search']) : ''; ?>" oninput="submitForm()">
        <button type="submit"><i class="fa-solid fa-search"></i></button>
    </form></div>
    <?php if(isset($_SESSION['success'])){ ?> <div class="message"><h3><?=$_SESSION['success'];  unset($_SESSION['success'])?></h3></div><?php } ?>
    <table>
        <thead>
            <tr>
                <th>SN</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Gender</th>
                <th>Contact</th>
                <th>D.O.R</th>
                <th>Address</th>
                <th>Amount</th>
                <th>Service</th>
                <th>Duration</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if(($res->num_rows)==0){ ?>
            <tr>
                <td colspan="11">NO RECORD FOUND</td>
            </tr>
       <?php } else { while($row=mysqli_fetch_assoc($res)){ ?>
            <tr>
                <td><?=$sn++?></td>
                <td><?=$row['fullname']?></td>
                <td><?=$row['username']?></td>
                <td><?=$row['gender']?></td>
                <td><?=$row['contact']?></td>
                <td><?=$row['dor']?></td>
                <td><?=$row['address']?></td>
                <td><?=$row['cost']?></td>
                <td><?=$row['service_name']?></td>
                <td><?=$row['plan']?> Months</td>
                <td>
                    <a href="update-member.php?id=<?=$row['id']?>" title="Update Member's Info" class="update"><i class="fa-solid fa-edit"></i></a>
                </td>
                <td>
                    <a href="member-delete.php?id=<?=$row['id']?>" title="Delete Member" class="delete"><i class="fa-solid fa-trash"></i></a>
                </td>
            </tr>
            <?php }} ?>
        </tbody>
    </table>
</div>


<?php include 'includes/footer.php'?>