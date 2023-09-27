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
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// get session id
$patientID = $_SESSION['user_id'];
$phone_note = $_POST['text_note'];
$email_note = $_POST['email_note'];

echo "$email_note"; 

$sqlID = "UPDATE Patient SET NotificationsEmail, NotficationsPhone VALUE (?, ?) WHERE PatientID = $patientID";
$stmtID = $db->prepare($sqlID);
$stmtID->bind_param("ss", $phone_note, $email_note); 
$stmt->execute();

  // Redirecting to the settingspage with a key value pair changed=1 OBS a GET method maybe better to use POST
  header("location: http://localhost:8888/frontend/Settings/Settings_Page.php?changed=1");

?>



