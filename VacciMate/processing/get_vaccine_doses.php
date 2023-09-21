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

// prepare sql statement
$sql = "SELECT
    VD.DoseID,
    VD.DoseNumber,
    VD.AdministrationDate,
    DATE_ADD(VD.AdministrationDate, INTERVAL VS.MaximumGap DAY) AS DoseExpirationDate,
    V.VaccineName,
    VS.MinimumGap,
    VS.MaximumGap
FROM
    VaccineDose VD
JOIN
    VaccineSchedule VS ON VD.DoseNumber = VS.DoseNumber AND VD.VaccineID = VS.VaccineID
JOIN
    Vaccine V ON VD.VaccineID = V.VaccineID
WHERE
    VD.PatientID = ?
ORDER BY
    VD.AdministrationDate DESC";


$stmt = $db->prepare($sql);
$stmt->bind_param("s", $patientID);
$stmt->execute();

$stmt->bind_result($doseID, $doseNumber, $administrationDate, $doseExpirationDate, $vaccineName, $minimumGap, $maximumGap);

// create a dictionary with vaccine name as id and the
// Close the statement

// Fetch and store the results in the array
// Fetch and store the results in the array
while ($stmt->fetch()) {
    $vaccines[] = array(
        'DoseID' => $doseID,
        'DoseNumber' => $doseNumber,
        'AdministrationDate' => $administrationDate,
        'DoseExpirationDate' => $doseExpirationDate,
        'VaccineName' => $vaccineName,
        'MinimumGap' => $minimumGap,
        'MaximumGap' => $maximumGap
    );
}

// Close the statement
$stmt->close();

// Convert the dictionary to JSON
$data_json = json_encode($vaccines);

// Set the response content type to JSON
header('Content-Type: application/json');

// Send the JSON response
echo $data_json;


?>

