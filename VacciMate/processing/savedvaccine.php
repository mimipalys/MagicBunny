<?php
session_start();
echo $_SESSION['user_id'];
echo $_SERVER["DOCUMENT_ROOT"];

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

<body>
<header>
  <div class= "topheader">
    <a id = "GFG" class="vaccimateLogo" href = "<?php $my_page ?>"> &#128137 VacciMate </a> 
    <div class= "rightpart_topheader">
     <a id = "GFG" href = "<?php echo $my_page ?>" class="costumbutton1"> My Pages </a>
     <a id = "GFG" href = "<?php echo $logout ?>" class="costumbutton1"> Logout </a>
     <a id = "GFG" href = "<?php echo $setting_link ?>" class="costumbutton1"> &#9881 </a> 
    </div>
  </div>

  <div class= "bottomheader">
    <a id = "GFG" href = "<?php echo $homepage_link; ?>"  class="costumbutton2"> Home </a>
    <a id = "GFG" href = "<?php echo $my_page; ?>"  class="costumbutton2"> My Doses and Refills </a> 
    <a id = "GFG" href = "<?php echo $savedvaccine_link; ?>" class="costumbutton2"> Saved Vaccines   </a> 
    <a id = "GFG" href = "<?php echo $aboutUs_link;  ?>" class="costumbutton2"> About Us </a> 
  </div>

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
    </style>
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
$sql = "SELECT DISTINCT Vaccine.VaccineName, Vaccine.VaccineID FROM Vaccine JOIN SavedVaccine ON Vaccine.VaccineID = SavedVaccine.VaccineID WHERE SavedVaccine.PatientID = $patientID";
$saved_vaccines = $link->query($sql);

// create a list for saved vacciens
echo '<section class="vaccinerecord">';
echo '<h1>Saved vaccines</h1>';

//creates a list of all the vaccines a patient has
$sql_doses = "SELECT DISTINCT VaccineID FROM VaccineDose WHERE PatientID = $patientID";
$sql_doses_result = $link->query($sql_doses);
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
      $sql_delete = "DELETE FROM SavedVaccine WHERE PatientID = $patientID AND VaccineID = $vaccineID";
      $result_delete = $link->query($sql_delete); 
    }

    //Prints out the Name of the saved vaccine
    echo '<section class="vaccine_description1">';
    $VaccineName = $row['VaccineName'];
    echo $VaccineName;

    //Creates a link to search vaccine page with the vaccine name as search query
    $vaccineLink = "http://localhost:8888/processing/search_vaccine.php?search_query=" . urlencode($VaccineName);
    echo "<a href='$vaccineLink' class='highlight-link'>Click here to read more about this vaccine</a>";
      

    //add unsave vaccine button
    echo '<form action="savedvaccine.php" method="post">';
    echo '<input type="submit" name='.$row['VaccineID'].' class="button" value="Unsave this vaccine" />';
    echo '</form>';

    //If the button is clicked delete the vaccine from saved vaccines. 
    if(isset($_POST[$row['VaccineID']])) { 
        $vaccineID = $row['VaccineID'];
        $sql_delete2 = "DELETE FROM SavedVaccine WHERE PatientID = $patientID AND VaccineID = $vaccineID";
        $result_delete2 = $link->query($sql_delete2);
    }
    echo '</section>';
}
echo '</section>';

//remove doses if they have taken them


?>