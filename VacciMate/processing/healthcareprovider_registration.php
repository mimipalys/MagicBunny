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

// REGISTER

$username = $_POST['ID'];
$password = $_POST['password'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$clinicID = $_POST['clinicID'];

$hashed_password = password_hash($password, PASSWORD_BCRYPT, ["cost"=>12]);

// protect against sql injection
$sql = "INSERT INTO HealthcareProvider (HealthcareProviderID, Fname, Lname, Password, VaccineClinicID) VALUES (?, ?, ?, ?, ?)";
$stmt = $db->prepare($sql);
$stmt->bind_param("isssi", $username, $fname, $lname, $hashed_password, $clinicID);
    
if ($stmt->execute()) {
    echo "Registration successful. <a href='index.php'>Login here</a>";
} else {
    echo "Registration failed. Error: " . $db->error;
}    

$stmt->close();
?>
