<?php
// Frontend for viewing your vaccine history
// Display vaccine doses and refills when the corresponding button is pressed
// Have an if-statement to check the user's role
session_start();

// Check if the user is logged in; if not, redirect to the signIn.php page
if (!isset($_SESSION['user_id']) or $_SESSION['role'] != "patient") {
  header("Location: ../../SignupandSingnin/signIn.php");
  exit;
}

include('../../links.php');

?>

<!DOCTYPE html>
<html>

<head>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <link rel="stylesheet" type="text/css" href="../../borderstyle.css">
    <link rel="stylesheet" type="text/css" href="mypages_patient.css">
  <title>
    Using display: flex and justify-content: space-between
  </title>
</head>

<?php include $header_my_page_patient; ?>
<main>
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
        method: 'GET', // HTTP method
        dataType: 'json', // Expected data type
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
            vaccineItem += '<h4> Dose Number' + '&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ' + 'Administration Date' + '&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp' + 'Dose Expiration Date</h4>';
            vaccineItem += '<p> &nbsp &nbsp &nbsp' + vaccine['DoseNumber'] + '  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp' + vaccine['AdministrationDate'] + '&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp' + vaccine['DoseExpirationDate'] + '</p>' ;
            
            // Assuming vaccineItem is the container element
            vaccineItem += '<form action="../../Feedback/feedback.php" method="post"> <input type="hidden" name="Vaccine" value="' + vaccine['VaccineName'] + '"> <input type="submit" class="register-vaccine-form" value="Report side effect"/></form>';
            //vaccineItem += '<form action="../../Feedback/feedback.php" method="post" class="register-vaccine-form">';
            //vaccineItem += '<button class="register-vaccine-button" onclick="Feedback(event)">Report Side Effect</button>';
    
            vaccineItem += '</li>';
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
            refillItem += '<div><h5 style="display: inline;">Dose Number: </h5>' + upcoming_refill['DoseNumber'] + '</div>';
            refillItem += '<div><h5 style="display: inline;">Earliest Date: </h5>' + upcoming_refill['EarliestDateToTake'] + '</div>';
            refillItem += '<div><h5 style="display: inline;">Latest Date: </h5>' + upcoming_refill['LatestDateToTake'] + '</div>';
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
</main>
<!-- Display upcoming vaccine doses to the right in a box -->
</body>

<?php
include $footer;
?>
</html>

