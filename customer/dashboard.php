<?php
include '../dbcon.php';
include 'includes/authentication.php';

// Fetching User ID
$uid = $_SESSION['uid'];

// Fetching To-Do List
$sql_todo = "SELECT * FROM todo WHERE user_id='$uid'";
$result_todo = mysqli_query($conn, $sql_todo);

// Deleting Completed Task
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql_complete_task = "DELETE FROM todo WHERE id='$id'";
    if (mysqli_query($conn, $sql_complete_task)) {
        header('Location:dashboard.php');
        $_SESSION['success'] = "Task Completed Successfully";
        exit();
    }
}

// Fetching Training Plan Link
$plan_sql = "SELECT plan_link FROM members WHERE id=$uid";
$plan_res = mysqli_query($conn, $plan_sql);
$plan_link = mysqli_fetch_assoc($plan_res)['plan_link'];

// Fetching Assigned Trainer
$trainer_sql = "SELECT staffs.fullname AS trainer_name, members.trainer_id
               FROM members
               LEFT JOIN staffs ON members.trainer_id = staffs.id
               WHERE members.id = $uid";
$trainer_res = mysqli_query($conn, $trainer_sql);
$trainer_row = mysqli_fetch_assoc($trainer_res);

if ($trainer_row && ($trainer_row['trainer_id'] !== null && $trainer_row['trainer_id'] !== '0')) {
    $trainer_name = $trainer_row['trainer_name'];
} else {
    $trainer_name = "Trainer Not Assigned Yet";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitManage Hub</title>
    <script src="https://kit.fontawesome.com/426c1a4028.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/boilerplate.css">
    <link rel="stylesheet" href="css/dashboard.css">
</head>

<body>
    <?php include 'includes/boilerplate.php'; ?>
    <div class="content">
        <div class="top">
            <div class="to-do">
                <h2>My To-Do-List</h2>
                <p></p>
                <table>
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Status</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($result_todo as $task) { ?>
                            <tr>
                                <td><?= $task['task_desc'] ?></td>
                                <td><?= $task['task_status'] ?></td>
                                <td>
                                    <a href="update-todo.php?id=<?= $task['id'] ?>" class="update" title="Update"><span><i
                                                class="fa-solid fa-pen-to-square"></i></span></a>
                                </td>
                                <td>
                                    <a href="dashboard.php?id=<?= $task['id'] ?>" class="complete" title="Complete"><span><i
                                                class="fa-solid fa-square-check"></i></span></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="announcement">
                <h2>Gym Announcement <span class="hide-show"><i class="fa-solid fa-chevron-down icon"></i></span></h2>
                <div class="announce-list">
                    <?php
                    $sql_announcements = "SELECT * FROM announcements";
                    $result_announcements = mysqli_query($conn, $sql_announcements);
                    while ($row = mysqli_fetch_assoc($result_announcements)) {
                        ?>
                        <div class="announce">
                            <span class="ann"><i class="fa-solid fa-bullhorn"></i></span>
                            <div class="message">
                                <h3><?= $row['message'] ?></h3>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="trainer-info">
            <h2>Assigned Trainer: <?= $trainer_name ?></h2>
        </div>
        <div class="bottom">
            <h1>Workout Routine</h1>
            <?php if ($plan_link) { ?>
                <iframe class="plan" src="<?= $plan_link ?>" width="100%" height="600px"></iframe>
                <div class="sheet"><a href="<?= $plan_link ?>" target="_blank">&#8594;Open in Google Sheets</a></div>
            <?php } else { ?>
                <p>Training Plan is not added yet.</p>
            <?php } ?>
        </div>
        
    </div>

    <?php include 'includes/footer.php' ?>

</body>

</html>
