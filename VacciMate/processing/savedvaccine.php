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

  <div class="vaccinerecord">
    <h1>Saved vaccines</h1>
    <ul class="vaccine-list">
      <!-- List items will be dynamically added here -->
    </ul>
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

echo '<section class="vaccinerecord">';
echo '<h1>Saved vaccines</h1>';
while($row = $saved_vaccines->fetch_assoc()){
    echo '<section class="vaccine_description1">';
    echo $row['VaccineName'];

    //add unsave vaccine button
    echo '<form action="savedvaccine.php" method="post">';
    echo '<input type="submit" name='.$row['VaccineID'].' class="button" value="Unsave this vaccine" />';
    echo '</form>';

    //If the button is clicked add the infomration in the database 

    if(isset($_POST[$row['VaccineID']])) { 
        $vaccineID = $row['VaccineID'];
        $sql_delete = "DELETE FROM SavedVaccine WHERE PatientID = $patientID AND VaccineID = $vaccineID";
        $result_delete = $link->query($sql_delete);
    }
    echo '</section>';
}
echo '</section>';

//remove doses if they have taken them
$sql_doses = "SELECT DISTINCT VaccineID FROM VaccineDose WHERE PatientID = $patientID";
$patientdoses = $link->query($sql_doses);


?>