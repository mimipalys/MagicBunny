<?php
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


 $uppcoming_notification = $_POST['Uppcoming'];
 $news_notification = $_POST['News'];
 $appointment_notification = $_POST['Appointment'];

 // when save is pressed; 
 // change notification attribue in table to true or false deppending on checked or not. 

 // Build the SQL query
 //$sql = "SELECT VaccineName, Description FROM Vaccine";
 //$result = $link->query($sql);

 // Close the database connection
 //$link->close();

  // Make this echo back tp settingsscreen when added to the DB
  echo "<h1> Notification settings succesfully changed <h1/>"; 
  //header("Location ../frontend/Setting/Settings_Page.php.$message"); 

 //header("location: http://localhost:8888/frontend/Settings/Settings_Page.php");
 //echo "<h1> Your settings has been saved </h1>"; 
 //header("location: http://localhost:8888/frontend/Settings/Settings_Page.php"); //replaces 1.html
?>



