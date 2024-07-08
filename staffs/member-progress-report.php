<?php
include '../dbcon.php';
include "includes/authentication.php";

$trainer_id = $_SESSION['uid'];


//Display Information
$sql="SELECT members.*, services.service_name
    FROM members
    LEFT JOIN services ON members.services_id=services.id
            WHERE members.trainer_id = $trainer_id";

// Searching Users
if (!empty($_POST)) {
    $search = $_POST['search'];
    if (!empty($search)) {
        $sql .= " AND (CONCAT(members.fullname, services.service_name) LIKE '%$search%')";
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
        <title>FitManage Hub - Trainer</title>
        <link rel="stylesheet" href="css/member-progress-report.css">
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
            <div class="heading">
            <h2><i class="fa-solid fa-chart-simple" style="margin-right: 0.5rem"></i>Member's Progress Report</h2>
            <form action="member-progress-report.php" method="post" id="searchForm">
                <input type="text" id="searchField" placeholder="Search" name="search"
                    value="<?php echo isset($_POST['search']) ? htmlspecialchars($_POST['search']) : ''; ?>"
                    oninput="submitForm()">
                <button type="submit"><i class="fa-solid fa-search"></i></button>
            </form>
            </div>
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