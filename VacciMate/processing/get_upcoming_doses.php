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
    MAX(VD.DoseNumber) AS LatestDoseNumber,
    MAX(VD.AdministrationDate) AS LatestAdministrationDate
FROM
    VaccineDose VD
JOIN 
    Vaccine as V
ON
    V.VaccineID = VD.VaccineID
WHERE
    VD.PatientID = ?
GROUP BY
    VD.PatientID,
    VD.VaccineID";

$stmt = $db->prepare($sql);
$stmt->bind_param("s", $patientID);
$stmt->execute();

$stmt->bind_result($vaccineName, $patientID, $vaccineID, $LatestDoseNumber, $LatestAdministrationDate);

// Create an associative array to store the results
$results = array();

while ($stmt->fetch()) {
    $results[] = array(
        "VaccineName" => $vaccineName,
        "PatientID" => $patientID,
        "VaccineID" => $vaccineID,
        "LatestDoseNumber" => $LatestDoseNumber,
        "LatestAdministrationDate" => $LatestAdministrationDate
    );
}
$stmt->close();
echo count($results);
echo "HELLO";

// create array for upcoming vaccines
$upcoming_doses = array();

// Loop through the results and check if there's either a +1 bigger dose or "Refill" for each vaccine
foreach ($results as $result) {
    $vaccineID = $result["VaccineID"];
    $latestDoseNumber = $result["LatestDoseNumber"];

    // Check if there's a dose number that is +1 greater than the latest dose
    // get vaccine name, dosenumber, minimum and maximum gap
    $sql = "SELECT 
        V.VaccineName, VS.DoseNumber, VS.MinimumGap, VS.MaximumGap 
    FROM 
        VaccineSchedule AS VS 
    JOIN 
        Vaccine AS V 
    ON 
        V.VaccineID = VS.VaccineID 
    WHERE 
        V.VaccineID = ? AND DoseNumber = ?";
    
    $stmt = $db->prepare($sql);
    
    $nextDoseNumber = $latestDoseNumber + 1;
    $stmt->bind_param("is", $vaccineID, $nextDoseNumber);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Next dose exists, fetch and handle it
        $stmt->bind_result($vaccineName, $nextDoseNumber, $minimumGap, $maximumGap);
        $stmt->fetch();
        
        // calculate interval to take next dose
        // add minimumgap to admin date of previous dose
        $earliestDateToTake = date('Y-m-d', strtotime($LatestAdministrationDate. ' + ' . $minimumGap . 'days'));
        $latestDateToTake = date('Y-m-d', strtotime($LatestAdministrationDate. ' + ' . $maximumGap . 'days'));

        $upcoming_doses[] = array(
            "VaccineName" => $vaccineName,
            "DoseNumber" => $nextDoseNumber,
            "MinimumGap" => $minimumGap,
            "MaximumGap" => $maximumGap,
            "EarliestDateToTake" => $earliestDateToTake
        );

        echo "Upcoming Dose:\n";
        echo "Vaccine Name: " . $vaccineName . "\n";
        echo "Dose Number: " . $nextDoseNumber . "\n";
        echo "Minimum Gap: " . $minimumGap . " days\n";
        echo "Maximum Gap: " . $maximumGap . " days\n";
        echo "earliest date: " . $earliestDateToTake . ' ';
        echo "latest date: " . $latestDateToTake;
        
    } else {
        // Next dose doesn't exist, check if there's a "Refill"
        // $sql = "SELECT DoseNumber FROM VaccineSchedule WHERE VaccineID = ? AND DoseNumber = 'Refill'";
        $sql = "SELECT 
        V.VaccineName, VS.DoseNumber, VS.MinimumGap, VS.MaximumGap 
    FROM 
        VaccineSchedule AS VS 
    JOIN 
        Vaccine AS V 
    ON 
        V.VaccineID = VS.VaccineID 
    WHERE 
        V.VaccineID = ? AND DoseNumber = 'Refill'";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $vaccineID);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Refill exists, fetch and handle it
            $stmt->bind_result($vaccineName, $nextDoseNumber, $minimumGap, $maximumGap);
            $stmt->fetch();

            // calculate interval to take refill
            $earliestDateToTake = date('Y-m-d', strtotime($LatestAdministrationDate. ' + ' . $minimumGap . 'days'));
            $latestDateToTake = date('Y-m-d', strtotime($LatestAdministrationDate. ' + ' . $maximumGap . 'days'));    
            
            // Handle the refill here, for example, display or store the information
            // add to array of upcoming doses
            echo "Refill for VaccineID $vaccineID: DoseNumber = $refillDoseNumber <br>";
            
            echo "Upcoming Dose:\n";
            echo "Vaccine Name: " . $vaccineName . "\n";
            echo "Dose Number: " . $refillDoseNumber . "\n";
            echo "Minimum Gap: " . $minimumGap . " days\n";
            echo "Maximum Gap: " . $maximumGap . " days\n";
            echo "earliest date: " . $earliestDateToTake . ' ';
            echo "latest date: " . $latestDateToTake;
            
        }
    }
}


// if there is a nextdose, get it else check if there is a refill and fetch that if not, do nothing
// do this for each dose found previosuly


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