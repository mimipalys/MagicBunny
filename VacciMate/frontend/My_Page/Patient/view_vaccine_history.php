<?php
// Frontend for viewing your vaccine history
// display  vaccine doses and refills when that button is pressed, display shcedules when that button is pressed
// have if-statement to check
session_start();
echo "frontend: ";
echo $_SESSION['user_id'];
echo $_SERVER["DOCUMENT_ROOT"]
?>


<!DOCTYPE html>
<html>

<head>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <link rel="stylesheet" type="text/css" href="borderstyle.css">
  <title>
          Using display: flex and 
          justify-content: space-between
  </title>
</head>

<body>
 <header>
  <div class= "topheader">
    <a class="vaccimateLogo"> &#128137 VacciMate </a> 
    <div class= "rightpart_topheader">
     <a id = "GFG" href = "http://localhost:8888/processing/index.php" class="costumbutton1"> Login </a> 
     <a id = "GFG" href = "http://localhost:8888/processing/index.php" class="costumbutton1"> Register </a> 
     <a id = "GFG" href = "http://localhost:8888/processing/index.php" class="costumbutton1"> &#9881 </a> 
    </div>
  </div>

  <div class= "bottomheader">
    <a id = "GFG" href = "http://localhost:8888/processing/index.php" class="costumbutton2"> My Doses and Refills </a> 
    <a id = "GFG" href = "http://localhost:8888/processing/search_vaccine.php" class="costumbutton2"> View Active Dose Schedules </a> 
    <a id = "GFG" href = "http://localhost:8888/processing/index.php" class="costumbutton2"> About Us </a> 
  </div>

  <div class="newscolumns ">
        <h1>Vaccine Dose Information</h1>
        <?php // index.php 
        include $_SERVER["DOCUMENT_ROOT"] . "/processing/get_vaccine_doses.php"; ?>
    </div>

 </body>
 <script>
$(document).ready(function() {
    // Function to fetch data from PHP using AJAX
    function fetchData() {
        $.ajax({
            url: $_SERVER["DOCUMENT_ROOT"] . "/processing/get_vaccine_doses.php", // PHP file that generates the data
            method: 'GET',       // HTTP method (GET or POST)
            dataType: 'json',    // Expected data type
            success: function(response) {
                // Handle the response data here
                // In this example, we'll simply display it in an alert
                alert('Name: ' + response.name + '\nEmail: ' + response.email + '\nAge: ' + response.age);
            },
            error: function(xhr, status, error) {
                // Handle errors here
                console.error('AJAX Error: ' + status + ' - ' + error);
            }
        });
    }

    // Call the fetchData function when the page loads
    fetchData();
});
</script>


</body>
</html>
