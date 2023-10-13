<?php
session_start();

//links
include('../frontend/links.php'); 

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

// Sanitize and validate input data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

$username = test_input($_POST['ID']);
$password = test_input($_POST['password']);
$fname = test_input($_POST['fname']);
$lname = test_input($_POST['lname']);
$dateOfBirth = test_input($_POST['bday']);
$mailAddress = test_input($_POST['mail']);
$phoneNumber = test_input($_POST['phone']);
$address = test_input($_POST['address']);

// Input validation



if (!filter_var($mailAddress, FILTER_VALIDATE_EMAIL, FILTER_FLAG_EMAIL_UNICODE)) {
    echo "Invalid e-mail adress. Please try again";
    exit;
}

if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $dateOfBirth)) {
    echo "Invalid date of birth. Please try again";
    exit;
}

$hashed_password = password_hash($password, PASSWORD_BCRYPT, ["cost"=>12]);

// protect against sql injection
$sql = "INSERT INTO Patient (PatientID, Fname, Lname, DateOfBirth, Password, MailAddress, PhoneNumber, Address) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $db->prepare($sql);
$stmt->bind_param("isssssss", $username, $fname, $lname, $dateOfBirth, $hashed_password, $mailAddress, $phoneNumber, $address);
    
if ($stmt->execute()) {
    echo "Registration successful. <a href=$login_link >Login here</a>";
} else {
    echo "Registration failed. Error: " . $db->error;
}    

$stmt->close();
?>
