<?php

if($_SESSION['is_login'] != true || $_SESSION['role'] != 'member'){
    $_SESSION['error'] = "Must Login to Access";
    header("Location: index.php");
}
