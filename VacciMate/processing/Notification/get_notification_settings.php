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

// Check if the user is logged in; if not, redirect to the signIn.php page
if (!isset($_SESSION['user_id'])or $_SESSION['role'] != "patient") {
    header("Location: $login_link");
    exit;
}

// get session id
$patientID = $_SESSION['user_id'];

// Variables for notifications
$refill_check;
$saved_check;

// Prepare SQL statement
$sql = "SELECT
    NotificationsSaved, 
    NotificationsRefill, 
    PatientID
FROM
    Patient
WHERE
    PatientID = ?"; 

$stmt = $db->prepare($sql);
$stmt->bind_param("s", $patientID);
$stmt->execute();

$stmt->bind_result($saved_check, $refill_check);

// Fetch the data
$stmt->fetch();

// Close the statement
$stmt->close();

// Create an associative array to hold the values
$data = array(
    'saved_check' => $saved_check,
    'refill_check' => $refill_check
);

// Convert the array to JSON
$data_json = json_encode($data);

// Set the response content type to JSON
header('Content-Type: application/json');

// Send the JSON response
echo $data_json;

?>

