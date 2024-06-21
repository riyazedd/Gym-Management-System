<?php
include '../dbcon.php';

//For displaying TO-DO List//
$uid = $_SESSION['uid'];
$sql = "SELECT * FROM todo WHERE user_id='$uid'";
$result = mysqli_query($conn, $sql);

//FOR COMPLETED TASK
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM todo WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        header('Location:dashboard.php');
        $_SESSION['success'] = "Task Completed Successfully";
    }
}

//for training plan
$plan_sql="SELECT plan_link FROM members WHERE id=$uid";
$plan_res=mysqli_query($conn,$plan_sql);

while($link=mysqli_fetch_assoc($plan_res)){
    $plan=$link['plan_link'];
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
                        <?php foreach ($result as $key => $task) { ?>
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
                    $sql = "SELECT * FROM announcements";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
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
        <div class="bottom">
            <h1>Workout Routine</h1>
            <iframe class="plan"
                    src="<?=$plan?>"
                    width="100%" height="600px"></iframe>
        </div>

    </div>

    <?php include 'includes/footer.php' ?>