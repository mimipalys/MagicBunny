<?php
// Database connection details
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = 'root';
$dbName = 'VacciMate';


// Create a connection to the database
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to fetch data from the database
function fetchDataFromDatabase($conn) {
    $data = array();

    // Replace 'your_table' with the name of your table and define the SQL query
    $sql = "SELECT * FROM ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    return $data;
}

// Fetch data from the database
$dataset = fetchDataFromDatabase($conn);

// Close the database connection
$conn->close();

// Return the dataset as JSON
header('Content-Type: application/json');
echo json_encode($dataset);
?>
