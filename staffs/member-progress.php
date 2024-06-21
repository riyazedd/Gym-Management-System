<?php
include '../dbcon.php';

//Displaying Members Progress(initial weight, current weight, progress)
$sql = "SELECT members.*,services.service_name, progress.ini_weight, progress.curr_weight, progress.ini_bodytype, progress.curr_bodytype
        FROM members
        LEFT JOIN progress ON members.id = progress.member_id
        LEFT JOIN services ON members.services_id = services.id
        ";

$res = mysqli_query($conn, $sql);
$sn = 1;

//Searching Users 
if (!empty($_POST)) {
    $search = $_POST['search'];
    if (!empty($search)) {
        $sql = "SELECT members.*,services.service_name, progress.ini_weight, progress.curr_weight, progress.ini_bodytype, progress.curr_bodytype
        FROM members
        LEFT JOIN progress ON members.id = progress.member_id
        LEFT JOIN services ON members.services_id = services.id WHERE CONCAT(fullname,service_name) LIKE '%$search%'";
        $res = mysqli_query($conn, $sql);
    } else {
        $sql = "SELECT members.*,services.service_name, progress.ini_weight, progress.curr_weight, progress.ini_bodytype, progress.curr_bodytype
        FROM members
        LEFT JOIN progress ON members.id = progress.member_id
        LEFT JOIN services ON members.services_id = services.id";
        $res = mysqli_query($conn, $sql);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitManage Hub - Trainer</title>
    <link rel="stylesheet" href="css/member-progress.css">
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
    <?php include 'includes/template.php'; ?>

    <div class="content">
        <div class="heading">
            <h2><i class="fa-solid fa-chart-simple" style="margin-right: 0.5rem"></i>Member's Progress</h2>
            <form action="member-progress.php" method="post" id="searchForm">
                <input type="text" id="searchField" placeholder="Search" name="search"
                    value="<?php echo isset($_POST['search']) ? htmlspecialchars($_POST['search']) : ''; ?>"
                    oninput="submitForm()">
                <button type="submit"><i class="fa-solid fa-search"></i></button>
            </form>
        </div>
        <?php if (isset($_SESSION['success'])) { ?>
            <div class="message">
                <h3><?= $_SESSION['success'];
                unset($_SESSION['success']) ?></h3>
            </div><?php } ?>
        <table>
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Fullname</th>
                    <th>Initial Weight</th>
                    <th>Current Weight</th>
                    <th>Service</th>
                    <th>Progress</th>
                    <th>Action</th>
                    <th>Upload Plan</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($res)) { ?>
                    <tr>
                        <td><?= $sn++ ?></td>
                        <td><?= $row['fullname'] ?></td>
                        <td><?= $row['ini_weight'] ?></td>
                        <td><?= $row['curr_weight'] ?></td>
                        <td><?= $row['service_name'] ?></td>
                        <td><?php
                        if ($row['ini_weight'] < $row['curr_weight']) {
                            $diff = $row['curr_weight'] - $row['ini_weight'];
                            $progress = $diff . " Kg Gained";
                            echo $progress;
                        } else {
                            $diff = $row['ini_weight'] - $row['curr_weight'];
                            $progress = $diff . " Kg Lost";
                            echo $progress;
                        }
                        ?></td>
                        <td><a href="member-progress-update.php?id=<?= $row['id'] ?>"><button class="update">Edit</button></a>
                        </td>
                        <td><a href="upload_plan.php?id=<?= $row['id'] ?>"><button class="upload">Upload</button></a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>


    <?php include 'includes/footer.php' ?>