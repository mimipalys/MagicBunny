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

// Check if the user is logged in; if not, redirect to the signIn.php page WO IS LOGED IN? IT WORKED?
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}


// get session id
$patientID = $_SESSION['user_id'];
$refill_note = $_POST['refill_note'];
$saved_note = $_POST['saved_note'];

$sqlID = "UPDATE Patient SET NotificationsSaved = ?, NotificationsRefill = ? WHERE PatientID = ?";
$stmtID = $db->prepare($sqlID);
$stmtID->bind_param("ssi", $saved_note, $refill_note, $patientID);
$stmtID->execute();



header("location: http://localhost:8888/frontend/Settings/Settings_Page.php?changed=1");

  // Redirecting to the settingspage with a key value pair changed=1 OBS a GET method maybe better to use POST
  
?>



