<?php
include '../dbcon.php';

// Fetching Trainers with their Assigned Members Count
$trainer_sql = "SELECT staffs.*, COUNT(members.id) AS member_count
                FROM staffs
                LEFT JOIN members ON staffs.id = members.trainer_id
                GROUP BY staffs.id, staffs.fullname";
$trainer_res = mysqli_query($conn, $trainer_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitManage Hub - Admin</title>
    <link rel="stylesheet" href="css/staff-manage.css">
    <script src="https://kit.fontawesome.com/426c1a4028.js" crossorigin="anonymous"></script>  
    <script>
         // JavaScript function for delete confirmation
         function confirmDelete(event) {
            if (!confirm("Are you sure you want to delete this member?")) {
                event.preventDefault();
            }
        }
    </script> 
</head>
<body>
    
<?php include 'includes/template.php'; ?>

<div class="content">
    <h2><i class="fa-solid fa-list" style="margin-right: 0.5rem"></i>Trainers List</h2>
    <?php if(isset($_SESSION['success'])){ ?> <div class="message"><h3><?=$_SESSION['success'];  unset($_SESSION['success'])?></h3></div><?php } ?>
    
    <a href="staff-add.php"><button class="add">Add Trainer</button></a>
    <table>
        <thead>
            <tr>
                <th>SN</th>
                <th>Trainer Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Assigned Members</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $sn = 1; ?>
            <?php while($trainer = mysqli_fetch_assoc($trainer_res)) { ?>
            <tr>
                <td><?=$sn++?></td>
                <td><?=$trainer['fullname']?></td>
                <td><?=$trainer['email']?></td>
                <td><?=$trainer['contact']?></td>
                <td><?=$trainer['member_count']?></td>
                <td><a href="trainer-members.php?id=<?=$trainer['id']?>" class="view-members" title="View Members"><i class="fa-solid fa-eye"></i> View Members</a></td>
                <td><a href="staff-update.php?id=<?=$trainer['id']?>" class="update" title="Edit Staff Information"><i class="fa-solid fa-edit"></i></a></td>
                <td><a href="staff-delete.php?id=<?=$trainer['id']?>" class="delete" title="Delete Staff" onclick="confirmDelete(event)"><i class="fa-solid fa-trash"></i></a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>

</body>
</html>
