<?php

// Database connection details
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "VacciMate";

// Create connection
$link = mysqli_connect($servername, $username, $password, $dbname);

// Check if connection is established
if (mysqli_connect_error()) {
    die("Connection failed: " . mysqli_connect_error());
}

$vaccineID = $_POST['VaccineID'];
$patientID = $_POST['PatientID'];



$sql_delete2 = "DELETE FROM SavedVaccine WHERE PatientID = ? AND VaccineID = ?";
$stmt = $link->prepare($sql_delete2);
$stmt->bind_param("si", $patientID, $vaccineID);
$result_delete2 = $stmt->execute();
$result_delete2 = $stmt->get_result(); 


header("Location: savedvaccine.php");
?>