
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

$VacID = $_POST['VaccineID'];
$patientID = $_POST['PatientID'];

$sql_save = "INSERT INTO SavedVaccine (PatientID, VaccineID) VALUES (?, ?)";
$stmt = $link->prepare($sql_save);
$stmt->bind_param("si", $patientID, $VacID);
$result_save = $stmt->execute();
$result_save = $stmt->get_result();
$stmt->close();   

header("Location: search_vaccine.php");
?>