<?php
session_start();

if (!isset($_SESSION['user_id']) or $_SESSION['role'] != "patient" ) {
  header("Location: ../../SignupandSingnin/signIn.php");
  exit;
}

include('../frontend/links.php');
?>

<!DOCTYPE html>
<html>

<head>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <link rel="stylesheet" type="text/css" href="../frontend/borderstyle.css">
  <title>
          Using display: flex and 
          justify-content: space-between
  </title>
</head>

<?php include $header_my_page_patient; ?>
<main>
  <style>
        .vaccine_description1 {
                display: block;
                align-items: center;
                background-color: #ffffff;
                margin: auto;
                padding: 1rem 1rem;
                text-align: left;
                margin: 20px ; 
                width: 500px;
                Height: auto;
                border-radius:20px;
                }
                
                .vaccine_description1:hover {
  box-shadow: none;
}

                
      footer{
          margin-top: 30%;
      }
      
    </style>
</main>
</body>
</html>


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

// Check if the user is logged in; if not, redirect to the signIn.php page
if (!isset($_SESSION['user_id'])) {
    header("Location: signIn.php");
    exit;
}

// get session id
$patientID = $_SESSION['user_id'];

//build sql
$sql = "SELECT DISTINCT Vaccine.VaccineName, Vaccine.VaccineID FROM Vaccine JOIN SavedVaccine ON Vaccine.VaccineID = SavedVaccine.VaccineID WHERE SavedVaccine.PatientID = ?";
$stmt = $link->prepare($sql);
$stmt->bind_param("s", $patientID);
$saved_vaccines = $stmt->execute();
$saved_vaccines = $stmt->get_result();
?>
<div class="bottomheader">
    <?php
    echo '<h1>Saved vaccines</h1>
        <br>
        <p>Here you can view all the saved vacines</p>';
    // echo '<a id="GFG"  href="' . $homepage_link . '"> <img src="' . $logo_img3 . '" alt="test_pic"> </a>';
    ?>
</div>
<?php
// create a list for saved vacciens
echo '<section class="vaccinerecord">';
echo '<h1>Saved vaccines</h1>';

//creates a list of all the vaccines a patient has
$sql_doses = "SELECT DISTINCT VaccineID FROM VaccineDose WHERE PatientID = ?";
$stmt = $link->prepare($sql_doses);
$stmt->bind_param("s", $patientID);
$sql_doses_result = $stmt->execute();
$sql_doses_result = $stmt->get_result();

$patientdoses = array();
while ($row_doses = $sql_doses_result -> fetch_assoc()){
  array_push($patientdoses, $row_doses['VaccineID']);
}

// Created the viewable list of vaccines
while($row = $saved_vaccines->fetch_assoc()){

    //vaccine id variable
    $vaccineID = $row['VaccineID'];

    //Check if the saved vaccine is also in the list of the patients doses. If it is it deletes it from saved
    if (in_array($vaccineID, $patientdoses)){
      $sql_delete = "DELETE FROM SavedVaccine WHERE PatientID = ? AND VaccineID = ?";
      $stmt = $link->prepare($sql_delete);
      $stmt->bind_param("si", $patientID, $vaccineID);
      $result_delete = $stmt->execute();
      $result_delete = $stmt->get_result();  
    }

    //Prints out the Name of the saved vaccine
    echo '<section class="vaccine_description1">';
    $VaccineName = $row['VaccineName'];
    echo '<p>'.$VaccineName. "<br><br>".'</p>';

    //Creates a link to search vaccine page with the vaccine name as search query
    $vaccineLink = "http://localhost:8888/processing/search_vaccine.php?search_query=" . urlencode($VaccineName);
    echo "<a href='$vaccineLink'>Click here to read more about this vaccine</a>";
      

    //add unsave vaccine button
    echo '<form action="delete_saved.php" method="post">';
    echo '<input type="hidden" name ="VaccineID" value='.$row['VaccineID'].'>';
    echo '<input type="hidden" name ="PatientID" value='.$patientID.'>';
    echo '<input type="submit" class="register-vaccine-button" value="Unsave this vaccine" />';
    echo '</form>';

    //If the button is clicked delete the vaccine from saved vaccines. 
    echo '</section>';
}
echo '</section>';

//remove doses if they have taken them


?>


<?php
include $footer;
?>
