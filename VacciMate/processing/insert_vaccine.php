<?php
// Get data from frotendn register vaccine form and insert into database

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
if (!isset($_SESSION['user_id']) or $_SESSION['role'] != "caregiver") {
    header("Location: $login_link");
    exit;
}

// Sanitize and validate input data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

// fetch data from post method
$doseID = test_input($_POST["doseID"]);
$patientID = test_input($_POST["patientID"]);
$healthcareProviderID = test_input($_POST["healthcareProviderID"]);
$vaccineName =  test_input($_POST["vaccine"]);
$doseNumber = test_input($_POST["doseNumber"]);
$adminDate = test_input($_POST["administrationDate"]);

// get vaccineID of given vaccineName
$sql = "SELECT VaccineID FROM Vaccine WHERE VaccineName = ?";
$stmt = $db->prepare($sql);
$stmt->bind_param("s", $vaccineName);

// Execute the prepared statement
$stmt->execute();
$stmt->store_result();

// Check if the statement returns a value
if ($stmt->num_rows > 0) {
    // VaccineID found, do nothing
} else {
    exit("Vaccine Registration failed. Error: " . "No such vaccine");
}

$stmt->bind_result($vaccineID);
$stmt->fetch();
$stmt->close();


$sql = "INSERT INTO VaccineDose(DoseID, PatientID, HealthcareProviderID, VaccineID, DoseNumber, AdministrationDate)
VALUES (?, ?, ?, ?, ?, ?)";

// DoseID should be scanned by caregiver, PatientID input, HealthcareproviderID is automatically input,
// VaccineID might also be automatically input when scanned, and dose number + admin date has to be input 

$stmt = $db->prepare($sql);
$stmt->bind_param("isiiss", $doseID, $patientID, $healthcareProviderID, $vaccineID, $doseNumber, $adminDate);


if ($stmt->execute()) {
    echo "Vaccine Registration successful.";
} else {
    echo "Vaccine Registration failed. Error: " . $stmt->error;
}

$stmt->close();
$db->close();
?>