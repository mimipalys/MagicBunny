<?php


session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
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
    header("Location: signIn.php");
    exit;
}

// get session id
$patientID = $_SESSION['user_id'];

$sql = "SELECT Vaccine.VaccineName FROM Vaccine JOIN SavedVaccine ON Vaccine.VaccineID = SavedVaccine.VaccineID WHERE SavedVaccine.PatientID = $patientID"
$result = $link->query($sql);
while($row = $result->fetch_assoc()) {
    echo $row['VaccineName']
}
?>