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

// fetch data from post method
$doseID = $_POST["doseID"];
$patientID = $_POST["patientID"];
$healthcareProviderID = $_POST["healthcareProviderID"];
$vaccineID =  $_POST["vaccine"];
$doseNumber = $_POST["doseNumber"];
$adminDate = $_POST["administrationDate"];

echo $doseID;
echo $adminDate;

// check if patientID exists


$sql = "INSERT INTO VaccineDose(DoseID, PatientID, HealthcareProviderID, VaccineID, DoseNumber, AdministrationDate)
VALUES (?, ?, ?, ?, ?, ?)";

// DoseID should be scanned by caregiver, PatientID input, HealthcareproviderID is automatically input,
// VaccineID might also be automatically input when scanned, and dose number + admin date has to be input 

$stmt = $db->prepare($sql);
$stmt->bind_param("isiiss", $doseID, $patientID, $healthcareProviderID, $vaccineID, $doseNumber, $adminDate);

if ($stmt->execute()) {
    echo "Vaccine Registration successful.";
} else {
    echo "Vaccine Registration failed. Error: " . $db->error;
}  
?>