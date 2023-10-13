<?php 
//create an associative list with vaccine names and id 
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



$pythonScript = '
import Plotlylib
print("The square root of 16 is:", math.sqrt(16))
';

?>

