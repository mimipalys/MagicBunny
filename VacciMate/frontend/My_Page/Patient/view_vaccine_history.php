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

  <link rel="stylesheet" type="text/css" href="../../homepage/borderstyle.css">
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

  <!-- <div class="newscolumns", id="vaccinedoses">
        <h1>Vaccine Dose Information</h1>
  </div> -->

  <div class="vaccinerecord">
    <h1>Vaccine Dose Information</h1>
    <ul class="vaccine-list">
      <!-- List items will be dynamically added here -->
    </ul>
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
                // Select the container where you'll append the list
                var vaccineContainer = $('.vaccinerecord');

                // Create an unordered list for the vaccines
                var vaccineList = $('<ul class="vaccine-list"></ul>');

                // Loop through the vaccine information and generate list items for each vaccine
                $.each(response, function(index, vaccine) {
                    if (vaccine['MaximumGap'] == 0) {
                        vaccine['DoseExpirationDate'] = "Life long";
                    }

                    // Create a list item for the current vaccine
                    var vaccineItem = '<li class="vaccine-info">';
                    vaccineItem += '<h3>' + vaccine['VaccineName'] + '</h3>';
                    vaccineItem += '<p>Dose Number: ' + vaccine['DoseNumber'] + '</p>';
                    vaccineItem += '<p>Administration Date: ' + vaccine['AdministrationDate'] + '</p>';
                    vaccineItem += '<p>Dose Expiration Date: ' + vaccine['DoseExpirationDate'] + '</p>';
                    vaccineItem += '</li>';

                    // Append the list item to the unordered list
                    vaccineList.append(vaccineItem);
                });

                // Append the unordered list to the container
                vaccineContainer.append(vaccineList);
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
