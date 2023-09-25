<?php
// Frontend for viewing your vaccine history
// display  vaccine doses and refills when that button is pressed, display shcedules when that button is pressed
// have if-statement to check
session_start();
echo "frontend: ";
echo $_SESSION['user_id'];
echo $_SERVER["DOCUMENT_ROOT"];


?>

<!DOCTYPE html>
<html>

<head>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <link rel="stylesheet" type="text/css" href="../../borderstyle.css">
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
      <a id = "GFG" href = "../../../processing/logout.php" class="costumbutton1"> Logout </a>
     <button id = "GFG" href = "http://localhost:8888/processing/index.php" class="costumbutton1"> My Pages </button>
     <button id = "GFG" href = "http://localhost:8888/processing/index.php" class="costumbutton1"> &#9881 </button> 
    </div>
  </div>

  <div class= "bottomheader">
    <a id = "GFG" href = "../../homepage/frontpage.php" class="costumbutton2"> Home </a>
    <a id = "GFG" href = "view_vaccine_history.php" class="costumbutton2"> My Doses and Refills </a> 
    <a id = "GFG" href = "http://localhost:8888/processing/search_vaccine.php" class="costumbutton2"> Saved Vaccines   </a> 
    <a id = "GFG" href = "../../About_Us/About_Us.php" class="costumbutton2"> About Us </a> 
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
                    vaccineItem += '<h4> Dose Number' + '&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp '+ 'Administration Date' + '&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp' + 'Dose Expiration Date</h4>';
                    vaccineItem += '<p> &nbsp &nbsp &nbsp' + vaccine['DoseNumber'] + '  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp'+ vaccine['AdministrationDate'] + '&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp' + vaccine['DoseExpirationDate'] + '</p>';
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

<div class="upcoming_refill_container">
  <h1>Upcoming Refills</h1>
  <ul class="refill-list">
    <!-- List items will be dynamically added here -->
  </ul>
</div>

<script>
  // Fetch data from "get_upcoming_refills.php" and display
  $(document).ready(function() {
  // Function to fetch upcoming refill data from "get_upcoming_refills.php" using AJAX and display it on the web page
  function fetchUpcomingRefillDataAndDisplay() {
    $.ajax({
      url: "/processing/get_upcoming_refills.php",
      method: "GET",
      dataType: 'json',
      success: function(response) {
        var upcoming_refills_box = $('.upcoming_refill_container');
        var refillList = $('<ul class="refill-list"></ul>'); // Create an unordered list for the refills

        $.each(response, function(index, upcoming_refill) {
          // Create a list item for the current upcoming refill
          var refillItem = '<li class="refill-info">';
          refillItem += '<h3>' + upcoming_refill['VaccineName'] + '</h3>';
          refillItem += '<h4>Dose Number: ' + upcoming_refill['DoseNumber'] + '</h4>';
          refillItem += '<h4>Earliest Date: ' + upcoming_refill['EarliestDateToTake'] + '</h4>';
          refillItem += '<h4>Latest Date: ' + upcoming_refill['LatestDateToTake'] + '</h4>';
          refillItem += '</li>';

          // Append the list item to the unordered list
          refillList.append(refillItem);
        });

        // Append the unordered list to the container
        upcoming_refills_box.append(refillList);
      },
      error: function(xhr, status, error) {
        // Handle errors here
        console.error('AJAX Error: ' + status + ' - ' + error);
      }
    });
  }

  // Call the fetchUpcomingRefillDataAndDisplay function when the page is loaded
  fetchUpcomingRefillDataAndDisplay();
});

</script>


<!-- Display upcoming vaccine doses to the right in a box -->




</body>
</html>
