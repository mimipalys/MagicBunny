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
    <a id = "GFG" href = "view_vaccine_history.php" class="costumbutton2"> My Doses and Refills </a> 
    <a id = "GFG" href = "http://localhost:8888/processing/search_vaccine.php" class="costumbutton2"> View Active Dose Schedules </a> 
    <a id = "GFG" href = "http://localhost:8888/processing/index.php" class="costumbutton2"> About Us </a> 
  </div>

  <div class="newscolumns", id="vaccinedoses">
        <h1>Vaccine Dose Information</h1>
  </div>

  <div class="vaccinerecord">
        <h1>Vaccine Dos e Information</h1>
  </div>

<script>
$(document).ready(function() {
    // Function to fetch vaccine data from PHP using AJAX and display it on the web page
    function fetchVaccineDataAndDisplay() {
        $.ajax({
            url: "/processing/get_vaccine_doses.php", // PHP file that generates the data
            method: 'GET',                 // HTTP method
            dataType: 'json',             // Expected data type
            success: function(response) {
                // Display the data on the web page
                var vaccineContainer = $('.vaccinerecord');

                // Loop through the vaccine information and generate divs for each vaccine
                $.each(response, function(index, vaccine) {
                    if (vaccine['MaximumGap'] == 0) {
                      vaccine['DoseExpirationDate'] = "Life long"

                    }
                    var vaccineDiv = '<div class="vaccine-info">';
                    vaccineDiv += '<h3>' + vaccine['VaccineName'] + '</h3>';
                    vaccineDiv += '<p>Dose Number: ' + vaccine['DoseNumber'] + '</p>';
                    vaccineDiv += '<p>Administration Date: ' + vaccine['AdministrationDate'] + '</p>';
                    vaccineDiv += '<p>Dose Expiration Date: ' + vaccine['DoseExpirationDate'] + '</p>';
                    vaccineDiv += '</div>';

                    vaccineContainer.append(vaccineDiv);
                });
            },
            error: function(xhr, status, error) {
                // Handle errors here
                console.error('AJAX Error: ' + status + ' - ' + error);
            }
        });
    }

    // Call the fetchVaccineDataAndDisplay function when the page is loaded
    fetchVaccineDataAndDisplay();
});
</script>

</body>
</html>
