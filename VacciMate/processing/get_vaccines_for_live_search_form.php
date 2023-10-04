<?php
session_start();

// Database connection details
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = 'root';
$dbName = 'VacciMate';

// Create a database connection
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check the connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Get the user input from the AJAX request
$input = "%".$_GET['input']."%";

$sql = "SELECT VaccineName, VaccineID FROM Vaccine WHERE VaccineName LIKE ?";
$stmt = $db->prepare($sql);
$stmt->bind_param("s", $input);

// Execute the prepared statement
$stmt->execute();

// Bind the result variables
$stmt->bind_result($vaccineName, $vaccineID);

// Store the matching vaccine names in an array
$vaccineNames = array();
while ($stmt->fetch()) {
    $vaccineNames[] = $vaccineName;
    // $vaccineID[] = $vaccineID;
}

// Return the matching vaccine names as JSON
echo json_encode($vaccineNames);

$stmt->close();
?>
