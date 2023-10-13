<?php
// delete a user's account from the VacciMate database
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

include('../frontend/links.php');


// Check if the user is logged in; if not, redirect to the signIn.php page
if (!isset($_SESSION['user_id'])or $_SESSION['role'] != "patient") {
    header("Location: $login_link");
    exit;
}

// get session id
$patientID = $_SESSION['user_id'];

$sql = "DELETE FROM Patient WHERE PatientID = ?";
$stmt = $db->prepare($sql);
$stmt->bind_param("s", $patientID);

if ($stmt->execute()) {
    echo "Your account has been successfully deleted!";
    unset($_SESSION['user_id']);
    unset($_SESSION['username']);
    unset($_SESSION['role']);
    // Destroy the session
    session_destroy();
    header("Location: ../frontend/homepage/frontpage.php");
} else {
    echo "There was an issue deleting your account. Please try again or contact VacciMate customer support.";
}

$stmt->close();
?>
