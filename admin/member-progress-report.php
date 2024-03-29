<?php
include '../dbcon.php';

//Display Information
$sql="SELECT members.*, services.service_name
    FROM members
    LEFT JOIN services ON members.services_id=services.id";
$res=mysqli_query($conn,$sql);
$sn=1;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FitManage Hub - Admin</title>
        <link rel="stylesheet" href="css/member-progress-report.css">
        <script src="https://kit.fontawesome.com/426c1a4028.js" crossorigin="anonymous"></script>   
    </head>
    <body>
        
        <?php include 'includes/template.php';?>
        <div class="content">
            <h2><i class="fa-solid fa-chart-simple" style="margin-right: 0.5rem"></i>Member's Progress Report</h2>
    <table>
        <thead>
            <tr>
                <th>SN</th>
                <th>Fullname</th>
                <th>Service</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($user=mysqli_fetch_assoc($res)){ ?>
            <tr>
                <td><?=$sn++?></td>
                <td><?=$user['fullname']?></td>
                <td><?=$user['service_name']?></td>
                <td><a href="view-progress-report.php?id=<?=$user['id']?>"><i class="fa-solid fa-file" style="margin-right:0.5rem;"></i>View Progress Report</a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>