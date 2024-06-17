<?php
require_once "../dbcon.php";

// For male and female chart
$query = "SELECT gender, COUNT(*) as count FROM members GROUP BY gender";
$result = mysqli_query($conn, $query);

$genderDataPoints = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
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
    while($row = $service_result->fetch_assoc()) {
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
        <div class="bottom">
            <h1>Workout Routine</h1>
            <iframe class="plan"
                src="https://docs.google.com/spreadsheets/d/e/2PACX-1vSS5FYdawuKHTX09gx-N6LJi7bEFFU388OyZjxCEKkGWPPw406g5WcQrrPJrW6hVgnZ3qDiup9fA-dO/pubhtml?widget=true&amp;headers=false"
                width="100%" height="500px"></iframe>
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
