<?php
include '../dbcon.php';
$errors = []; // Array to store error messages

if (!empty($_POST)) {
    $fname = trim($_POST['fullname'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $contact = trim($_POST['contact'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $gender = $_POST['gender'] ?? '';
    $plan = $_POST['plan'] ?? '';
    $services = $_POST['services'] ?? '';
    $dor = date("Y-m-d");

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
    if (empty($contact)) {
        $errors['contact'] = "Contact Number is required.";
    }
    if (empty($address)) {
        $errors['address'] = "Address is required.";
    }
    if (empty($gender)) {
        $errors['gender'] = "Gender is required.";
    }
    if (empty($plan)) {
        $errors['plan'] = "Plan is required.";
    }
    if (empty($services)) {
        $errors['services'] = "Service is required.";
    }

    // Check if username exists
    if (empty($errors['username'])) {
        $username_check_query = "SELECT * FROM members WHERE username='$username'";
        $username_check_result = mysqli_query($conn, $username_check_query);

        if (mysqli_num_rows($username_check_result) > 0) {
            $errors['username'] = "Username already taken.";
        }
    }

    if (empty($errors)) {
        // Hash the password
        $hashed_password = md5($password);

        $sql = "INSERT INTO members (fullname, username, password, contact, address, gender, plan, services_id, dor) VALUES ('$fname', '$username', '$hashed_password', '$contact', '$address', '$gender', '$plan', '$services', '$dor')";

        $result = mysqli_query($conn, $sql);
        if ($result) {
            $_SESSION['success'] = "Registered Successfully";
        } else {
            $_SESSION['error'] = "Error Registering User";
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
    <link rel="stylesheet" href="css/member-registration.css">
    <script src="https://kit.fontawesome.com/426c1a4028.js" crossorigin="anonymous"></script>   
    <style>
        .errors { color: red; }
    </style>
</head>
<body>
    
    <?php include 'includes/template.php';?>
    <div class="content">
        <h2>New Member Register Form</h2>
        <?php if(isset($_SESSION['success'])){ ?> <div class="message"><h3><?=$_SESSION['success']; unset($_SESSION['success'])?></h3></div><?php } ?>
        <?php if(isset($_SESSION['error'])){ ?> <div class="error"><h3><?=$_SESSION['error']; unset($_SESSION['error'])?></h3></div><?php } ?>
        <div class="form-container">
            <form action="" method="post">
                <div class="personal">
                    <h3>Personal-Info</h3>
                    <label for="fullname">Full Name: <?php if(!empty($errors)){?><span class="errors"><?php echo $errors['fullname'] ?? ''; ?></span><?php } ?></label>
                    <input type="text" name="fullname" value="<?php echo htmlspecialchars($fname ?? '', ENT_QUOTES); ?>"><br>
                    
                    
                    <label for="username">Username: <?php if(!empty($errors)){?><span class="errors"><?php echo $errors['username'] ?? ''; ?></span><?php } ?></label>
                    <input type="text" name="username" value="<?php echo htmlspecialchars($username ?? '', ENT_QUOTES); ?>"><br>
                    
                    
                    <label for="password">Password: <?php if(!empty($errors)){?><span class="errors"><?php echo $errors['password'] ?? ''; ?></span><?php } ?></label>
                    <input type="password" name="password" value="<?php echo htmlspecialchars($password ?? '', ENT_QUOTES); ?>"><br>
                   
                    
                    <label for="gender">Gender: <?php if(!empty($errors)){?><span class="errors"><?php echo $errors['gender'] ?? ''; ?></span><?php } ?></label>
                    <select name="gender">
                        <option value="" disabled hidden selected>Select Gender</option>
                        <option value="male" <?php if (($gender ?? '') == 'male') echo 'selected'; ?>>Male</option>
                        <option value="female" <?php if (($gender ?? '') == 'female') echo 'selected'; ?>>Female</option>
                        <option value="other" <?php if (($gender ?? '') == 'other') echo 'selected'; ?>>Others</option>
                    </select><br>
                    
                    <label for="dor">D.O.R: </label>
                    <input type="date" name="dor" value="<?php echo htmlspecialchars($dor ?? '', ENT_QUOTES); ?>"><br>
                </div>
                <div class="other">
                    <div class="contact">
                        <h3>Contact Details</h3>
                        <label for="contact">Contact Number: <?php if(!empty($errors)){?><span class="errors"><?php echo $errors['contact'] ?? ''; ?></span><?php } ?></label>
                        <input type="number" name="contact" value="<?php echo htmlspecialchars($contact ?? '', ENT_QUOTES); ?>"><br>
                        
                        
                        <label for="address">Address: <?php if(!empty($errors)){?><span class="errors"><?php echo $errors['address'] ?? ''; ?></span><?php } ?></label>
                        <input type="text" name="address" value="<?php echo htmlspecialchars($address ?? '', ENT_QUOTES); ?>"><br>
                    
                    </div>
                    <hr>
                    <div class="service">
                        <h3>Service Details</h3>
                        <label for="service">Services: <?php if(!empty($errors)){?><span class="errors"><?php echo $errors['services'] ?? ''; ?></span><?php } ?></label>
                        <select name="services">
                            <option value="" disabled hidden selected>Select Service</option>
                            <?php
                            $service_query = "SELECT id, service_name FROM services";
                            $service_result = mysqli_query($conn, $service_query);
                            if ($service_result && mysqli_num_rows($service_result) > 0) {
                                while ($row = mysqli_fetch_assoc($service_result)) {
                                    $service_id = $row['id'];
                                    $service_name = $row['service_name'];
                                    echo "<option value='$service_id' ".(($services ?? '') == $service_id ? 'selected' : '').">$service_name</option>";
                                }
                            }
                            ?>
                        </select><br>
                        
                        <br>
                        <label for="duration">Duration: <?php if(!empty($errors)){?><span class="errors"><?php echo $errors['plan'] ?? ''; ?></span><?php } ?></label>
                        <select name="plan">
                            <option value="" disabled hidden selected>Select Plan</option>
                            <option value="1" <?php if (($plan ?? '') == '1') echo 'selected'; ?>>One Month</option>
                            <option value="3" <?php if (($plan ?? '') == '3') echo 'selected'; ?>>Three Month</option>
                            <option value="6" <?php if (($plan ?? '') == '6') echo 'selected'; ?>>Six Month</option>
                            <option value="12" <?php if (($plan ?? '') == '12') echo 'selected'; ?>>One Year</option>
                        </select><br>
                    </div>
                    <button type="submit">Register Member</button>
                </div>
            </form>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
