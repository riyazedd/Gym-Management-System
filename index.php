<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth   = true;
        $mail->Username   = 'riyaz.shrestha00@gmail.com'; // SMTP username
        $mail->Password   = 'oihs wwzp iorv lazt'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        //Recipients
        $mail->setFrom($email, $fullname);
        $mail->addAddress('riyaz.shrestha00@gmail.com'); // Add a recipient

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body    = "<h2>Contact Form Submission</h2>
                          <p><strong>Fullname:</strong> {$fullname}</p>
                          <p><strong>Contact:</strong> {$contact}</p>
                          <p><strong>Email:</strong> {$email}</p>
                          <p><strong>Message:</strong><br>{$message}</p>";

        $mail->send();
        $_SESSION['success']="Message Sent";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <script src="https://kit.fontawesome.com/426c1a4028.js" crossorigin="anonymous"></script>
    <title>FitManage Hub</title>
</head>

<body>
    <nav>
        <a href="index.php"><img src="images/logo.png" alt=""></a>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#contact">Contact</a></li>
            <li class="dropdown"><a href="login.html">Account</a>
                <ul>
                    <li><a href="customer/login.php">Login</a></li>
                    <li><a href="customer/signup.php">Sign up</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- //home -->
    <section id="home" class="">
        <div class="container slide-in-left">
            <div class="content">
                <h1>FitManage Hub</h1>
                <p>Transforming Bodies, Empowering Lives.</p>
                <a href="customer/signup.php">Begin Your Journey</a>
            </div>
            <p class="login_p">Already a Member? <a href="customer/login.php" class="login">Log in</a></p>
        </div>
    </section>

    <!-- //services -->
    <section id="services" class="">
        <div class="services-container slide-in-left">
            <h1>Our Services</h1>
            <p class="services_p">A variety of services to help you achieve your fitness goals.</p>
            <div class="services-content">
                <div class="service-card">
                    <i class="fa-solid fa-dumbbell"></i>
                    <h2>Fitness Center</h2>
                    <p>Our fitness center is equipped with the latest machines and weights to help you reach your
                        fitness goals.</p>
                </div>
                <div class="service-card">
                    <i class="fa-solid fa-heart-pulse"></i>
                    <h2>Cardio Zone</h2>
                    <p>Our cardio zone includes state-of-the-art treadmills, bikes, and elliptical machines to keep your
                        heart healthy.</p>
                </div>
                <div class="service-card">
                    <i class="fa-solid fa-bath"></i>
                    <h2>Sauna & Relaxation</h2>
                    <p>Unwind in our sauna after a workout. The perfect way to relax your muscles and clear your mind.
                    </p>
                </div>
                <div class="service-card">
                    <i class="fa-solid fa-dumbbell"></i>
                    <h2>Weight & Strength</h2>
                    <p>Build your strength with our free weights and resistance training equipment.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- //Contact -->
    <section id="contact" class="">
        <div class="contact-container slide-in-left">
            <h1>Contact Us</h1>
            <p class="services_p">Reach out to us to begin your journey</p>
            <?php if(isset($_SESSION['success'])){ ?> <div class="message"><h3><?php echo $_SESSION['success'];  unset($_SESSION['success'])?></h3></div><?php } ?>
            <div class="contact-info">
                <div class="contacts">
                    <div class="phone contact-div">
                        <i class="fa-solid fa-phone"></i>
                        <p>+977 9876543210, 44553321</p>
                    </div>
                    <div class="email contact-div">
                        <i class="fa-solid fa-envelope"></i>
                        <p>fitmanagehub@gmail.com</p>
                    </div>
                    <div class="map contact-div">
                        <i class="fa-solid fa-location-dot"></i>
                        <p>Putalisadak, Kathmandu</p>
                    </div>
                </div>
                <div class="contact-form">
                    <form action="" method="POST">
                        <input type="text" placeholder="Fullname" name="fullname">
                        <input type="text" placeholder="Contact" name="contact">
                        <input type="text" placeholder="Email" name="email">
                        <textarea name="message" id="" placeholder="Enter your message..."  rows="5" cols="50"></textarea>
                        <button type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const sliders = document.querySelectorAll('.slide-in-left');

            const appearOptions = {
                threshold: 0,
                rootMargin: "0px 0px -150px 0px"
            };

            const appearOnScroll = new IntersectionObserver(function (entries, appearOnScroll) {
                entries.forEach(entry => {
                    if (!entry.isIntersecting) {
                        return;
                    } else {
                        entry.target.classList.add('show');
                        appearOnScroll.unobserve(entry.target);
                    }
                });
            }, appearOptions);

            sliders.forEach(slider => {
                appearOnScroll.observe(slider);
            });
        });
    </script>

</body>

</html>