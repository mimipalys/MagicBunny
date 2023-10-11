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

include('../frontend/links.php');


// Check if the user is logged in; if not, redirect to the signIn.php page
if (!isset($_SESSION['user_id']) or $_SESSION['role'] != "caregiver") {
    header("Location: $login_link");
    exit;
}

$employeID = $_SESSION['user_id'];

$sql = "SELECT vd.DoseID, v.VaccineName, vs.DoseNumber, vd.AdministrationDate
FROM VaccineDose vd
JOIN Vaccine v ON vd.VaccineID = v.VaccineID
JOIN VaccineSchedule vs ON vd.DoseNumber = vs.DoseNumber AND vd.VaccineID = vs.VaccineID
WHERE vd.HealthcareProviderID = ?";

$stmt = $db->prepare($sql);
if (!$stmt) {
    die("Error in SQL query: " . $db->error);
}
$stmt->bind_param("s", $employeID);
$stmt->execute();

$stmt->bind_result($doseID, $vaccineName, $doseNumber, $adminDate);

$results = array();

while ($stmt->fetch()) {
    $results[] = array(
        "DoseID" => $doseID,
        "VaccineName" => $vaccineName,
        "DoseNumber" => $doseNumber,
        "AdminDate" => $adminDate
    );
}

$stmt->close();

// Convert the dictionary to JSON
$data_json = json_encode($results);

// Set the response content type to JSON
header('Content-Type: application/json');

// Send the JSON response
echo $data_json;

?>