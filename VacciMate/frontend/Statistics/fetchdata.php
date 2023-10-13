<?php
// Database connection parameters
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = 'root';
$dbName = 'VacciMate';

// Create a database connection
$connection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Fetch data from the 'statistics' table
$query = "SELECT vaccineID, value FROM vaccinedose";
$result = $connection->query($query);

// Initialize arrays to store data
$categories = array();
$values = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row['vaccineID'];
        $values[] = $row['vaccinedose'];
    }
}

$connection->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Chart Example</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div style="width: 80%;">
        <canvas id="lineChart"></canvas>
    </div>
    <div style="width: 80%;">
        <canvas id="pieChart"></canvas>
    </div>

    <script>
        // Data fetched from the database
        var categories = <?php echo json_encode($categories); ?>;
        var values = <?php echo json_encode($values); ?>;

        // Line chart
        var lineCtx = document.getElementById("lineChart").getContext("2d");
        var lineChart = new Chart(lineCtx, {
            type: "line",
            data: {
                labels: categories,
                datasets: [{
                    label: "Line Chart",
                    data: values,
                    fill: false,
                    borderColor: "rgba(75, 192, 192, 1)",
                    borderWidth: 2,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            },
        });

        // Pie chart
        var pieCtx = document.getElementById("pieChart").getContext("2d");
        var pieChart = new Chart(pieCtx, {
            type: "pie",
            data: {
                labels: categories,
                datasets: [{
                    data: values,
                    backgroundColor: ["red", "blue", "green", "orange", "purple"],
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            },
        });
    </script>
</body>

</html>
