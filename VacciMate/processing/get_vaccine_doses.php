<?php
session_start();
echo "Hello \n";
echo "backend: ";
echo $_SESSION['user_id'];


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
    VD.AdministrationDate";


$stmt = $db->prepare($sql);
$stmt->bind_param("s", $patientID);
$stmt->execute();

$stmt->bind_result($doseID, $doseNumber, $administrationDate, $doseExpirationDate, $vaccineName, $minimumGap, $maximumGap);

// Fetch and display the results
while ($stmt->fetch()) {
    // Access the retrieved values
    echo "Dose ID: $doseID<br>";
    echo "Dose Number: $doseNumber<br>";
    echo "Administration Date: $administrationDate<br>";
    echo "Dose Expiration Date: $doseExpirationDate<br>";
    echo "Vaccine Name: $vaccineName<br>";
    echo "Minimum Gap: $minimumGap<br>";
    echo "Maximum Gap: $maximumGap<br>";
}

// create a dictionary with vaccine name as id and the
// Close the statement
$stmt->close();


?>

