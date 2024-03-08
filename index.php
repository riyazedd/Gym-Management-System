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
            <li><a href="#">Contact</a></li>
            <li class="dropdown"><a href="login.html">Account</a>
                <ul>
                    <li><a href="login.html">Login</a></li>
                    <li><a href="signup.html">Sign up</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <section id="home">
        <div class="container">
            <div class="content">
                <h1>FitManage Hub</h1>
                <p>Transforming Bodies, Empowering Lives.</p>
                <a href="customer/signup.php">Begin Your Journey</a>
            </div>
            <p class="login_p">Already a Member? <a href="customer/login.php" class="login">Log in</a></p>   
        </div>
    </section>
    <section id="services">
        <div class="services-container">
            <h1>Our Services</h1>
            <p class="services_p">A variety of services to help you achieve your fitness goals.</p>
            <div class="services-content">
                <div class="service-card">
                    <i class="fa-solid fa-dumbbell"></i>
                    <h2>Fitness Center</h2>
                    <p>Our fitness center is equipped with the latest machines and weights to help you reach your fitness goals.</p>
                </div>
                <div class="service-card">
                    <i class="fa-solid fa-heart-pulse"></i>
                    <h2>Cardio Zone</h2>
                    <p>Our cardio zone includes state-of-the-art treadmills, bikes, and elliptical machines to keep your heart healthy.</p>
                </div>
                <div class="service-card">
                    <i class="fa-solid fa-bath"></i>
                    <h2>Sauna & Relaxation</h2>
                    <p>Unwind in our sauna after a workout. The perfect way to relax your muscles and clear your mind.</p>
                </div>
                <div class="service-card">
                    <i class="fa-solid fa-dumbbell"></i>
                    <h2>Weight & Strength</h2>
                    <p>Build your strength with our free weights and resistance training equipment.</p>
                </div>
            </div>
        </div>
    </section>
</body>
</html>