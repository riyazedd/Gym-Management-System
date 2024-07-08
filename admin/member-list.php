<?php 
include "../dbcon.php";

// Display Users
$sql = "SELECT members.*, services.service_name, services.cost, staffs.fullname AS trainer_name
        FROM members
        LEFT JOIN services ON members.services_id = services.id
        LEFT JOIN staffs ON members.trainer_id = staffs.id";
$res = mysqli_query($conn, $sql);
$sn = 1;

// Fetch trainers
$trainers_sql = "SELECT id, fullname FROM staffs";
$trainers_res = mysqli_query($conn, $trainers_sql);

// Searching Users 
if (!empty($_POST)) {
    $search = $_POST['search'];
    if (!empty($search)) {
        $sql = "SELECT members.*, services.service_name, services.cost, staffs.fullname AS trainer_name
                FROM members
                LEFT JOIN services ON members.services_id = services.id
                LEFT JOIN staffs ON members.trainer_id = staffs.id
                WHERE CONCAT(members.fullname, service_name) LIKE '%$search%'";
        $res = mysqli_query($conn, $sql);
    } else {
        $sql = "SELECT members.*, services.service_name, services.cost, staffs.fullname AS trainer_name
                FROM members
                LEFT JOIN services ON members.services_id = services.id
                LEFT JOIN staffs ON members.trainer_id = staffs.id";
        $res = mysqli_query($conn, $sql);
    }
}

// Handle trainer assignment
if (isset($_POST['assign_trainer'])) {
    $member_id = $_POST['member_id'];
    $trainer_id = $_POST['trainer_id'];
    
    $assign_sql = "UPDATE members SET trainer_id = '$trainer_id' WHERE id = '$member_id'";
    if (mysqli_query($conn, $assign_sql)) {
        $_SESSION['success'] = "Trainer assigned successfully!";
    } else {
        $_SESSION['error'] = "Failed to assign trainer.";
    }
    header('Location: member-list.php');
    exit();
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

        // JavaScript function for delete confirmation
        function confirmDelete(event) {
            if (!confirm("Are you sure you want to delete this member?")) {
                event.preventDefault();
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
    <?php if (isset($_SESSION['success'])) { ?> 
        <div class="message"><h3><?=$_SESSION['success'];  unset($_SESSION['success'])?></h3></div>
    <?php } ?>
    <?php if (isset($_SESSION['error'])) { ?> 
        <div class="message"><h3><?=$_SESSION['error'];  unset($_SESSION['error'])?></h3></div>
    <?php } ?>
    <table>
        <thead>
            <tr>
                <th>SN</th>
                <th>Full Name</th>
                <th>Gender</th>
                <th>Contact</th>
                <th>D.O.R</th>
                <th>Address</th>
                <th>Service</th>
                <th>Duration</th>
                <th>Trainer</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (($res->num_rows) == 0) { ?>
            <tr>
                <td colspan="12">NO RECORD FOUND</td>
            </tr>
            <?php } else { while ($row = mysqli_fetch_assoc($res)) { ?>
            <tr>
                <td><?=$sn++?></td>
                <td><?=$row['fullname']?></td>
                <td><?=$row['gender']?></td>
                <td><?=$row['contact']?></td>
                <td><?=$row['dor']?></td>
                <td><?=$row['address']?></td>
                <td><?=$row['service_name']?></td>
                <td><?=$row['plan']?> Months</td>
                <td><?=$row['trainer_name'] ?? 'Not Assigned'?></td>
                <td>
                    <form action="member-list.php" method="post">
                        <input type="hidden" name="member_id" value="<?=$row['id']?>">
                        <select name="trainer_id" onchange="this.form.submit()">
                            <option value="">Assign Trainer</option>
                            <?php 
                            // Reset trainer result pointer
                            mysqli_data_seek($trainers_res, 0);
                            while ($trainer = mysqli_fetch_assoc($trainers_res)) { ?>
                                <option value="<?=$trainer['id']?>"><?=$trainer['fullname']?></option>
                            <?php } ?>
                        </select>
                        <input type="hidden" name="assign_trainer" value="1">
                    </form>
                </td>
                <td>
                    <a href="update-member.php?id=<?=$row['id']?>" title="Update Member's Info" class="update"><i class="fa-solid fa-edit"></i></a>
                </td>
                <td>
                    <a href="member-delete.php?id=<?=$row['id']?>" title="Delete Member" class="delete" onclick="confirmDelete(event)"><i class="fa-solid fa-trash"></i></a>
                </td>
                
            </tr>
            <?php }} ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'?>
</body>
</html>
