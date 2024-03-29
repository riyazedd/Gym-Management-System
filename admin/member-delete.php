<?php
include '../dbcon.php';

//Deleting User
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Delete associated records from the progress table
    $delete_progress_sql = "DELETE FROM progress WHERE member_id = $id";
    mysqli_query($conn, $delete_progress_sql);

    // Then delete the member
    $sql = "DELETE FROM members WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['success'] = "Member Deleted Successfully";
        header("Location: member-list.php");
    }
}

?>