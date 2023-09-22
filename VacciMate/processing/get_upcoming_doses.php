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

// Check if the user is logged in; if not, redirect to the login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// get session id
$patientID = $_SESSION['user_id'];

// Initialize an empty array to store vaccine names
$vaccines = array();

// sql stmnt
// fetch only latest dose of vaccine and calculate next dose if they have one or have refill
$sql = "SELECT 
VD.DoseID,
VD.DoseNumber,
VD.AdministrationsDate,
VS.MinimumGap,
VS.MaximumGap,
V.VaccineName

FROM 
    VaccineDose AS VD, 
JOIN 
    VaccineSchedule VS ON VD.DoseNumber = VS.DoseNumber AND VD.VaccineID = VS.VaccineID
JOIN
    Vaccine V ON VD.VaccineID = V.VaccineID
WHERE
    VD.PatientID = ?
ORDER BY
    VD.AdministrationDate DESC"; 


// fetch results

// Vaccine Name
// Dose number
// interval of when to take it
// only display if it is within a years time




?>