<?php
include '../dbcon.php';
$errors = []; // Array to store error messages

if (!empty($_POST) && isset($_POST['add'])) {
    $fname = trim($_POST['fullname'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $email = trim($_POST['email'] ?? '');
    $contact = trim($_POST['contact'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $gender = $_POST['gender'] ?? '';
    $designation = $_POST['designation'] ?? '';

    // Validate all fields are filled
    if (empty($fname)) {
        $errors['fullname'] = "Full Name is required.";
    }
    if (empty($username)) {
        $errors['username'] = "Username is required.";
    }
    if (empty($password)) {
        $errors['password'] = "Password is required.";
    } elseif (strlen($password) <= 8) {
        $errors['password'] = "Password must be greater than 8 characters.";
    }
    if (empty($email)) {
        $errors['email'] = "Email is required.";
    }
    if (empty($contact)) {
        $errors['contact'] = "Contact Number is required.";
    }
    if (empty($address)) {
        $errors['address'] = "Address is required.";
    }
    if (empty($gender)) {
        $errors['gender'] = "Gender is required.";
    }
    if (empty($designation)) {
        $errors['designation'] = "Designation is required.";
    }

    // Check if username exists
    if (empty($errors['username'])) {
        $username_check_query = "SELECT * FROM staffs WHERE username='$username'";
        $username_check_result = mysqli_query($conn, $username_check_query);

        if (mysqli_num_rows($username_check_result) > 0) {
            $errors['username'] = "Username already taken.";
        }
    }

    if (empty($errors)) {
        // Hash the password
        $hashed_password = md5($password);

        $sql = "INSERT INTO staffs (fullname, username, password, email, contact, address, gender, designation) VALUES ('$fname', '$username', '$hashed_password', '$email', '$contact', '$address', '$gender', '$designation')";

        $result = mysqli_query($conn, $sql);
        if ($result) {
            $_SESSION['success'] = "New Staff Added";
        } else {
            $_SESSION['error'] = "Error Adding Staff";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitManage Hub - Admin</title>
    <link rel="stylesheet" href="css/staff-add.css">
    <script src="https://kit.fontawesome.com/426c1a4028.js" crossorigin="anonymous"></script>
    <style>
        .errors { color: red; }
    </style>
</head>
<body>
    
    <?php include 'includes/template.php';?>
    <div class="content">
        <h2><i class="fa-solid fa-edit" style="margin-right: 0.5rem"></i>Staff Registration Form</h2>
        <?php if(isset($_SESSION['success'])){ ?> <div class="message"><h3><?=$_SESSION['success']; unset($_SESSION['success'])?></h3></div><?php } ?>
        <?php if(isset($_SESSION['error'])){ ?> <div class="error"><h3><?=$_SESSION['error']; unset($_SESSION['error'])?></h3></div><?php } ?>
        <div class="form-container">
            <form action="" method="post">
                <div class="left">
                    <label for="fullname">Enter Fullname: <?php if(!empty($errors)){?><span class="errors"><?php echo $errors['fullname'] ?? ''; ?></span><?php } ?></label>
                    <input type="text" name="fullname" value="<?php echo htmlspecialchars($fname ?? '', ENT_QUOTES); ?>"><br>
                    
                    <label for="username">Enter Username: <?php if(!empty($errors)){?><span class="errors"><?php echo $errors['username'] ?? ''; ?></span><?php } ?></label>
                    <input type="text" name="username" value="<?php echo htmlspecialchars($username ?? '', ENT_QUOTES); ?>"><br>
                    
                    <label for="password">Password: <?php if(!empty($errors)){?><span class="errors"><?php echo $errors['password'] ?? ''; ?></span><?php } ?></label>
                    <input type="password" name="password"><br>
                    
                    <label for="gender">Gender: <?php if(!empty($errors)){?><span class="errors"><?php echo $errors['gender'] ?? ''; ?></span><?php } ?></label>
                    <select name="gender">
                        <option value="" disabled hidden selected>Select Gender</option>
                        <option value="Male" <?php if (($gender ?? '') == 'Male') echo 'selected'; ?>>Male</option>
                        <option value="Female" <?php if (($gender ?? '') == 'Female') echo 'selected'; ?>>Female</option>
                        <option value="Others" <?php if (($gender ?? '') == 'Others') echo 'selected'; ?>>Others</option>
                    </select><br>
                </div>
                <div class="right">
                    <label for="email">Email: <?php if(!empty($errors)){?><span class="errors"><?php echo $errors['email'] ?? ''; ?></span><?php } ?></label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($email ?? '', ENT_QUOTES); ?>"><br>
                    
                    <label for="contact">Contact: <?php if(!empty($errors)){?><span class="errors"><?php echo $errors['contact'] ?? ''; ?></span><?php } ?></label>
                    <input type="text" name="contact" value="<?php echo htmlspecialchars($contact ?? '', ENT_QUOTES); ?>"><br>
                    
                    <label for="address">Address: <?php if(!empty($errors)){?><span class="errors"><?php echo $errors['address'] ?? ''; ?></span><?php } ?></label>
                    <input type="text" name="address" value="<?php echo htmlspecialchars($address ?? '', ENT_QUOTES); ?>"><br>
                    
                    <label for="designation">Designation: <?php if(!empty($errors)){?><span class="errors"><?php echo $errors['designation'] ?? ''; ?></span><?php } ?></label>
                    <select name="designation">
                        <option value="" disabled hidden selected>Select Designation</option>
                        <option value="Cashier" <?php if (($designation ?? '') == 'Cashier') echo 'selected'; ?>>Cashier</option>
                        <option value="Trainer" <?php if (($designation ?? '') == 'Trainer') echo 'selected'; ?>>Trainer</option>
                        <option value="Gym Assistant" <?php if (($designation ?? '') == 'Gym Assistant') echo 'selected'; ?>>Gym Assistant</option>
                        <option value="Front Desk Officer" <?php if (($designation ?? '') == 'Front Desk Officer') echo 'selected'; ?>>Front Desk Officer</option>
                        <option value="Manager" <?php if (($designation ?? '') == 'Manager') echo 'selected'; ?>>Manager</option>
                    </select><br>
                    <button type="submit" name="add">Add Staff</button>
                </div>
            </form>
            <p class="back"><a href="staff-manage.php">&larr;Go back</a></p>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
