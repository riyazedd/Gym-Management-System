<?php
include "../dbcon.php";

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

    if (empty($fname)) {
        $errors['fullname'] = "Full Name is required";
    }
    if (empty($username)) {
        $errors['username'] = "Username is required";
    }
    if (empty($password)) {
        $errors['password'] = "Password is required";
    } elseif (strlen($password) <= 8) {
        $errors['password'] = "Password must be greater than 8 characters.";
    }
    if (empty($contact)) {
        $errors['contact'] = "Contact Number is required";
    }
    if (empty($address)) {
        $errors['address'] = "Address is required";
    }
    if (empty($gender)) {
        $errors['gender'] = "Gender is required";
    }
    if (empty($plan)) {
        $errors['plan'] = "Plan is required";
    }
    if (empty($services)) {
        $errors['services'] = "Service is required";
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

        $sql = "INSERT INTO members (fullname,username,password,contact,address,gender,plan,services_id,dor) VALUES
        ('$fname','$username','$hashed_password','$contact','$address','$gender','$plan','$services','$dor')";

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
    <title>Customer Sign Up</title>
    <link rel="stylesheet" href="./css/signup.css">
    <script src="https://kit.fontawesome.com/426c1a4028.js" crossorigin="anonymous"></script>
    <style>
        .error { color: red; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Customer Sign Up</h1>
        <p><?php 
            if (isset($_SESSION['success'])) {
                echo $_SESSION['success'];
                unset($_SESSION['success']);
            }
            if (isset($_SESSION['error'])) {
                echo $_SESSION['error'];
                unset($_SESSION['error']);
            }
        ?></p>
        <div class="form-container">
            <form action="" method="post">
                <div class="input-container">
                    <div class="error"><?php echo $errors['fullname'] ?? ''; ?></div>
                    <div class="input">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" name="fullname" placeholder="Full Name" value="<?php echo htmlspecialchars($fname ?? '', ENT_QUOTES); ?>" >
                    </div>
                    <div class="error"><?php echo $errors['username'] ?? ''; ?></div>
                    <div class="input">
                        <i class="fa-solid fa-at"></i>
                        <input type="text" name="username" placeholder="Username" value="<?php echo htmlspecialchars($username ?? '', ENT_QUOTES); ?>" >
                    </div>
                    <div class="error"><?php echo $errors['password'] ?? ''; ?></div>
                    <div class="input">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" value="<?php echo htmlspecialchars($password ?? '', ENT_QUOTES); ?>">
                    </div>
                    <div class="error"><?php echo $errors['contact'] ?? ''; ?></div>
                    <div class="input">
                        <i class="fa-solid fa-phone"></i>
                        <input type="text" name="contact" placeholder="Contact Number" value="<?php echo htmlspecialchars($contact ?? '', ENT_QUOTES); ?>" >
                    </div>
                    <div class="error"><?php echo $errors['address'] ?? ''; ?></div>
                    <div class="input">
                        <i class="fa-solid fa-location-dot"></i>
                        <input type="text" name="address" placeholder="Address" value="<?php echo htmlspecialchars($address ?? '', ENT_QUOTES); ?>" >
                    </div>
                    <div class="error"><?php echo $errors['gender'] ?? ''; ?></div>
                    <div class="input">
                        <i class="fa-solid fa-venus-mars"></i>
                        <select name="gender" >
                            <option selected disabled hidden value="">Select Gender</option>
                            <option value="male" <?php if (($gender ?? '') == 'male') echo 'selected'; ?>>Male</option>
                            <option value="female" <?php if (($gender ?? '') == 'female') echo 'selected'; ?>>Female</option>
                            <option value="others" <?php if (($gender ?? '') == 'others') echo 'selected'; ?>>Others</option>
                        </select>
                    </div>
                    <div class="error"><?php echo $errors['plan'] ?? ''; ?></div>
                    <div class="input">
                        <i class="fa-solid fa-hourglass"></i>
                        <select name="plan" >
                            <option selected disabled hidden value="">Select Plan</option>
                            <option value="1" <?php if (($plan ?? '') == '1') echo 'selected'; ?>>One Month</option>
                            <option value="3" <?php if (($plan ?? '') == '3') echo 'selected'; ?>>Three Months</option>
                            <option value="6" <?php if (($plan ?? '') == '6') echo 'selected'; ?>>Six Months</option>
                            <option value="12" <?php if (($plan ?? '') == '12') echo 'selected'; ?>>One Year</option>
                        </select>
                    </div>
                    <div class="error"><?php echo $errors['services'] ?? ''; ?></div>
                    <div class="input">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <select name="services" >
                            <option selected disabled hidden value="">Select Service</option>
                            <?php
                            // Assuming $conn is your database connection
                            $service_query = "SELECT id, service_name FROM services"; // Assuming your services table has columns id and service_name
                            $service_result = mysqli_query($conn, $service_query);
                            if ($service_result && mysqli_num_rows($service_result) > 0) {
                                while ($row = mysqli_fetch_assoc($service_result)) {
                                    $service_id = $row['id'];
                                    $service_name = $row['service_name'];
                                    echo "<option value='$service_id' ".(($services ?? '') == $service_id ? 'selected' : '').">$service_name</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="action">
                    <a href="index.php">Login</a>
                    <button type="submit">Submit Details</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
