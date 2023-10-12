<?php 
// Lets caregiver view dose ids, vaccine name and admin date, of admistered doses for better traceability

session_start();
$caregiverID = $_SESSION['user_id'];
include('../../links.php');

// Check if the user is logged in and is a caregiver; if not, redirect to the signIn.php page
if (!isset($_SESSION['user_id']) or $_SESSION['role'] != "caregiver" ) {
    header("Location: ../../SignupandSingnin/signIn.php");
    exit;
  }
?>

<!DOCTYPE html>
<html>

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="mypages_caregiver.css">
    <link rel="stylesheet" type="text/css" href="../../borderstyle.css">
    <title>Register Vaccine Dose</title>
</head>

<?php include $header_my_page_caregiver; ?>
<main>

<div class="administered_doses_container">
    <h1>Administered Doses</h1>
    <ul class="refill-list">
    <!-- List items will be dynamically added here -->
    </ul>
</div>


<script>
  // Fetch data from "get_upcoming_refills.php" and display
  $(document).ready(function() {
    // Function to fetch upcoming refill data from "get_upcoming_refills.php" using AJAX and display it on the web page
    function fetchAdministeredDosesAndDisplay() {
      $.ajax({
        url: "/processing/get_administered_vaccines.php",
        method: "GET",
        dataType: 'json',
        success: function(response) {
          var administered_vaccines_box = $('.administered_doses_container');
          var vaccine_list = $('<ul class="refill-list"></ul>');
          $.each(response, function(index, administered_dose) {
            // create list item for each administered dose
            var adminDoseItem = '<li class="refill-info">';
            adminDoseItem += '<h4> Dose ID' + '&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp'+ 'Vaccine' + '&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ' + 'Dose number' + '&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp' + ' Administration date' + '</h4>';
            adminDoseItem += '<p>' +  administered_dose['DoseID'] + ' &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp'+ administered_dose['VaccineName'] + '&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp' + administered_dose['DoseNumber'] + '  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp' + administered_dose['AdminDate'] + '</p>';
            adminDoseItem += '</li>';

            vaccine_list.append(adminDoseItem);
            
          });
          administered_vaccines_box.append(vaccine_list);
        },
        error: function(xhr, status, error) {
          // Handle errors here
          console.error('AJAX Error: ' + status + ' - ' + error);
        }
      });
    }

    // Call the ajax function
    fetchAdministeredDosesAndDisplay();
  });

</script>

<div class= "contact-box">
  <h1>Contact Us</h1>
  <p> vaccimate@mail.com </p> 
  <p> +46 1234 545 21</p>
  <h4> Monday - Friday: </h4>
  <p> 09:00 - 15:00 </p>

</div>
</main>
</body>
</html>
<?php
include $footer;
?>