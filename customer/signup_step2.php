<?php
include "../dbcon.php";

if (!isset($_SESSION['signup_data'])) {
    header('Location: signup_step1.php');
    exit();
}

$errors = []; // Array to store error messages

if (!empty($_POST)) {
    $plan = $_POST['plan'] ?? '';
    $services = $_POST['services'] ?? '';
    $dor = date("Y-m-d");

    if (empty($plan)) {
        $errors['plan'] = "Plan is required";
    }
    if (empty($services)) {
        $errors['services'] = "Service is required";
    }

    if (empty($errors)) {
        // Retrieve data from session
        $signup_data = $_SESSION['signup_data'];
        $fname = $signup_data['fullname'];
        $username = $signup_data['username'];
        $password = $signup_data['password'];
        $contact = $signup_data['contact'];
        $address = $signup_data['address'];
        $gender = $signup_data['gender'];

        // Hash the password
        $hashed_password = md5($password);

        $sql = "INSERT INTO members (fullname,username,password,contact,address,gender,plan,services_id,dor) VALUES
        ('$fname','$username','$hashed_password','$contact','$address','$gender','$plan','$services','$dor')";

        $result = mysqli_query($conn, $sql);
        if ($result) {
            unset($_SESSION['signup_data']);
            $_SESSION['success'] = "Registered Successfully";
            header('Location: index.php');
            exit();
        } else {
            $_SESSION['error'] = "Error Registering User";
            header('Location: signup.php');

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
        .error {
            color: red;
        }

    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const serviceCards = document.querySelectorAll('.service-card');
            serviceCards.forEach(card => {
                card.addEventListener('click', function () {
                    serviceCards.forEach(c => c.classList.remove('selected'));
                    card.classList.add('selected');
                    document.querySelector('input[name="services"]').value = card.dataset.serviceId;
                });
            });
        });
    </script>
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
            <div class="services-container">
                <h2>Select Service</h2>
                <div class="single-service"><?php
                $service_query = "SELECT * FROM services";
                $service_result = mysqli_query($conn, $service_query);
                if ($service_result && mysqli_num_rows($service_result) > 0) {
                    while ($row = mysqli_fetch_assoc($service_result)) {
                        $service_id = $row['id'];
                        $service_name = $row['service_name'];
                        $price = $row['cost'];
                        echo "<div class='service-card' data-service-id='$service_id'>
                                            <h3>$service_name</h3>
                                            <p>Price: Rs.$price/month</p>
                                          </div>";
                    }
                }
                ?></div>
            </div>
            <form action="" method="post">
                <div class="input-container plan">
                    <div class="error"><?php echo $errors['plan'] ?? ''; ?></div>
                    <div class="input">
                        <i class="fa-solid fa-hourglass"></i>
                        <select name="plan">
                            <option selected disabled hidden value="">Select Plan</option>
                            <option value="1" <?php if (($plan ?? '') == '1')
                                echo 'selected'; ?>>One Month</option>
                            <option value="3" <?php if (($plan ?? '') == '3')
                                echo 'selected'; ?>>Three Months</option>
                            <option value="6" <?php if (($plan ?? '') == '6')
                                echo 'selected'; ?>>Six Months</option>
                            <option value="12" <?php if (($plan ?? '') == '12')
                                echo 'selected'; ?>>One Year</option>
                        </select>
                    </div>
                    <div class="error"><?php echo $errors['services'] ?? ''; ?></div>
                    <div class="input">
                        <input type="hidden" name="services" value="">
                    </div>
                </div>
                <div class="action">
                    <button type="submit">Submit Details</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>