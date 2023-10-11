<?php
session_start();

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
  <link rel="stylesheet" type="text/css" href="borderstyle.css">
  <title>Using display: flex and justify-content: space-between</title>
</head>

<?php include $header_my_page_patient; ?>

<div class="vaccinerecord">
  <h1>Vaccine Dose Information</h1>
  <ul class="vaccine-list">
    <!-- List items will be dynamically added here -->
  </ul>
</div>

<div class="upcoming_refill_container">
  <h1>Upcoming Refills</h1>
  <ul class="refill-list">
    <!-- List items will be dynamically added here -->
  </ul>
</div>

<script>
  $(document).ready(function() {
    function fetchVaccineDataAndDisplay() {
      $.ajax({
        url: "/processing/get_vaccine_doses.php",
        method: 'GET',
        dataType: 'json',
        success: function(response) {
          var vaccineContainer = $('.vaccinerecord');
          var vaccineList = $('<ul class="vaccine-list"></ul>');

          $.each(response, function(index, vaccine) {
            if (vaccine['MaximumGap'] == 0) {
              vaccine['DoseExpirationDate'] = "Life long";
            }

            var vaccineItem = '<li class="vaccine-info">';
            vaccineItem += '<h3>' + vaccine['VaccineName'] + '</h3>';
            vaccineItem += '<h4> Dose Number' + '&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ' + 'Administration Date' + '&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp' + 'Dose Expiration Date</h4>';
            vaccineItem += '<p> &nbsp &nbsp &nbsp' + vaccine['DoseNumber'] + '  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp' + vaccine['AdministrationDate'] + '&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp' + vaccine['DoseExpirationDate'] + '</p>';
            
            // Add a "Feedback" button dynamically for each vaccine
            vaccineItem += '<a href="../../Feedback/feedback.html" class="feedback-button">Feedback</a>';
            
            vaccineItem += '</li>';
            vaccineList.append(vaccineItem);
          });

          vaccineContainer.append(vaccineList);
        },
        error: function(xhr, status, error) {
          console.error('AJAX Error: ' + status + ' - ' + error);
        }
      });
    }

    fetchVaccineDataAndDisplay();
  });
</script>

</body>

</html>
