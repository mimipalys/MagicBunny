<?php
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
// if (!isset($_SESSION['user_id'])) {
//     header("Location: index.php");
//     exit;
// }

// step 1: look if person wants any kind of notification. Save wich one. 
$sqlID = "UPDATE Patient SET NotificationsEmail = ?, NotificationsPhone = ? WHERE PatientID = ?";
$stmtID = $db->prepare($sqlID);
$stmtID->bind_param("ssi", $email_note, $phone_note, $patientID);
$stmtID->execute();



// Step 2: look if any vaccines connected to that person has a refil dose that is within the next 30 days. (here we need to get hold of todays date)


?>



