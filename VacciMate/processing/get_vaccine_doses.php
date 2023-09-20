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

// Check if the user is logged in; if not, redirect to the login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// get session id
$patientID = $_SESSION['user_id'];

// Initialize an empty array to store vaccine names
$vaccineNames = array();

// prepare sql statement
$sql = "SELECT DISTINCT
    V.VaccineName
FROM
    VaccineDose VD
JOIN
    VaccineSchedule VS ON VD.DoseNumber = VS.DoseNumber AND VD.VaccineID = VS.VaccineID
JOIN
    Vaccine V ON VD.VaccineID = V.VaccineID
WHERE
    VD.PatientID = ?
ORDER BY
    V.VaccineName";

$stmt = $db->prepare($sql);
$stmt->bind_param("s", $patientID);
$stmt->execute();

$stmt->bind_result($vaccineName);

// Fetch and store the results in the array
while ($stmt->fetch()) {
    // Add the retrieved value to the array
    $vaccineNames[] = $vaccineName;
}

// Close the statement
$stmt->close();

// Convert the dictionary to JSON
$data_json = json_encode($vaccineNames);

// Set the response content type to JSON
header('Content-Type: application/json');

// Send the JSON response
echo $data_json;


?>

