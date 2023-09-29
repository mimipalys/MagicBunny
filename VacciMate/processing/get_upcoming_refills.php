<?php

// check in vaccineDOse if the min/max gap is 0 or not.
// If it is anything but 0, there should be an upcoming vaccine dose

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

// Check if the user is logged in; if not, redirect to the signIn.php page
if (!isset($_SESSION['user_id'])) {
    header("Location: signIn.php.php");
    exit;
}

// get session id
$patientID = $_SESSION['user_id'];

// Execute the SQL query to get the latest doses for each vaccine
$sql = "SELECT
V.VaccineName,
VD.PatientID,
VD.VaccineID,
VD.DoseNumber AS LatestDoseNumber,
VD.AdministrationDate AS LatestAdministrationDate,
VS.MinimumGap,
VS.MaximumGap
FROM
VaccineDose VD
JOIN 
Vaccine AS V ON V.VaccineID = VD.VaccineID
JOIN
VaccineSchedule VS ON VD.DoseNumber = VS.DoseNumber AND VD.VaccineID = VS.VaccineID
WHERE
VD.PatientID = ?
AND (VD.DoseNumber, VD.AdministrationDate) = (
    SELECT
        MAX(DoseNumber),
        MAX(AdministrationDate)
    FROM
        VaccineDose
    WHERE
        PatientID = ?
        AND VaccineID = VD.VaccineID
)";

$stmt = $db->prepare($sql);
if (!$stmt) {
    die("Error in SQL query: " . $db->error);
}
$stmt->bind_param("ss", $patientID, $patientID);
$stmt->execute();

$stmt->bind_result($vaccineName, $patientID, $vaccineID, $LatestDoseNumber, $LatestAdministrationDate, $minGap, $maxGap);

// store results from query in array
$results = array();

while ($stmt->fetch()) {
    $results[] = array(
        "VaccineName" => $vaccineName,
        "PatientID" => $patientID,
        "VaccineID" => $vaccineID,
        "LatestDoseNumber" => $LatestDoseNumber,
        "LatestAdministrationDate" => $LatestAdministrationDate,
        "MinimumGap" => $minGap,
        "MaximumGap" => $maxGap
    );
}

$stmt->close();

//create array to store upcoming doses
$upcoming_doses = array();

//still have to somehow get the next dose, if it is refill or +1


// Loop through list of latest vaccine doses
foreach ($results as $result) {

    $LatestAdministrationDate = $result["LatestAdministrationDate"];
    $minimumGap = $result["MinimumGap"];
    $maximumGap = $result["MaximumGap"];
    $vaccineName = $result["VaccineName"];

    // check whether minimumGap is not 0, if it isn't, that means there is a "next dose"
    if ($minimumGap != 0) {
        // We don't know beforehand which type of dose it is, numbered or refill so we have to check in the DB
        // Create variable to store which type of next dose it is numbered or refill
        // We first start by assuming the dose is a numbered one
        $nextDoseNumber = $result["LatestDoseNumber"] + 1;
        //check whether next dose is refill or +1
        $sql = "SELECT DoseNumber FROM VaccineSchedule WHERE VaccineID = ? AND DoseNumber = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("is", $result["VaccineID"], $nextDoseNumber);
        $stmt->execute();
        $stmt->store_result();

        // If doesn't return a row, we known it's a Refill
        if ($stmt->num_rows == 0) {
            $nextDoseNumber = 'Refill';
        }
        
        // calculate the interval to take next dose
        $EarliestDateToTake = date('Y-m-d', strtotime($LatestAdministrationDate. ' + ' . $minimumGap . 'days')); // add admin date to minimum gap here
        $LatestDateToTake = date('Y-m-d', strtotime($LatestAdministrationDate. ' + ' . $maximumGap . 'days')); // add admin date to maximum gap here

        // store this dose in a new array
        $upcoming_doses[] = array(
            "VaccineName" => $vaccineName,
            "DoseNumber" => $nextDoseNumber,
            "EarliestDateToTake" => $EarliestDateToTake,
            "LatestDateToTake" => $LatestDateToTake
        );

        // Close the statement
        $stmt->close();
        

    }

}

// Convert the dictionary to JSON
$data_json = json_encode($upcoming_doses);

// Set the response content type to JSON
header('Content-Type: application/json');

// Send the JSON response
echo $data_json;

?>