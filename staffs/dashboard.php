<?php
require_once "../dbcon.php";

//Registered Member Count
$sql = "SELECT * FROM members";
$result = mysqli_query($conn, $sql);
$memberCount = mysqli_num_rows($result);

// For male and female chart
$query = "SELECT gender, COUNT(*) as count FROM members GROUP BY gender";
$result = mysqli_query($conn, $query);

$genderDataPoints = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $label = $row["gender"] == 'male' ? "Male" : "Female";
        $genderDataPoints[] = array("y" => $row["count"], "label" => $label);
    }
} else {
    // Handle the case when there are no records
    $genderDataPoints[] = array("y" => 0, "label" => "Male");
    $genderDataPoints[] = array("y" => 0, "label" => "Female");
}

// For services chart
$service_query = "
    SELECT services.service_name AS service_name, COUNT(members.id) AS count 
    FROM members
    JOIN services ON members.services_id = services.id
    GROUP BY services.service_name
";
$service_result = mysqli_query($conn, $service_query);

$serviceDataPoints = array();

if ($service_result->num_rows > 0) {
    while ($row = $service_result->fetch_assoc()) {
        $serviceDataPoints[] = array("y" => $row["count"], "label" => ucfirst($row["service_name"]));
    }
} else {
    // Handle the case when there are no records
    $serviceDataPoints[] = array("y" => 0, "label" => "Fitness");
    $serviceDataPoints[] = array("y" => 0, "label" => "Sauna");
    $serviceDataPoints[] = array("y" => 0, "label" => "Cardio");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
    <link rel="stylesheet" href="css/template.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <script src="https://kit.fontawesome.com/426c1a4028.js" crossorigin="anonymous"></script>
    <script>
        window.onload = function () {
            var genderChart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "light2",
                title: {
                    text: "Members by Gender"
                },
                axisY: {
                    title: "Number of Members"
                },
                data: [{
                    type: "column",
                    yValueFormatString: "#,##0.##",
                    dataPoints: <?php echo json_encode($genderDataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            genderChart.render();

            var serviceChart = new CanvasJS.Chart("serviceChartContainer", {
                animationEnabled: true,
                theme: "light2",
                title: {
                    text: "Members by Service"
                },
                axisY: {
                    title: "Number of Members"
                },
                data: [{
                    type: "column",
                    yValueFormatString: "#,##0.##",
                    dataPoints: <?php echo json_encode($serviceDataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            serviceChart.render();
        }
    </script>
</head>

<body>
    <?php include "includes/template.php" ?>
    <div class="content">
        <div class="info">
            <div class="stats">
                <div class="stat-box">
                    <i class="fa-solid fa-users"></i>
                    <h2 class="num"><?= $memberCount ?></h2>
                    <h2>Total Clients</h2>
                </div>
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
                            <div class="messages">
                                <h3><?= $row['message'] ?></h3>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="chart">
            <div id="chartContainer"></div>
            <div id="serviceChartContainer"></div>
        </div>
    </div>

    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

    <?php include "includes/footer.php" ?>
</body>

</html>