<?php 
// Lets caregiver view dose ids, vaccine name and admin date, of admistered doses for better traceability

session_start();
echo "frontend: ";
echo $_SESSION['user_id'];
echo $_SERVER["DOCUMENT_ROOT"];

$caregiverID = $_SESSION['user_id'];

// Check if the user is logged in and is a caregiver; if not, redirect to the signIn.php page
if (!isset($_SESSION['user_id']) or $_SESSION['role'] != "caregiver" ) {
    header("Location: ../../SignupandSingnin/signIn.php");
    exit;
  }

// include("../../../processing/get_administered_vaccines.php");
?>

<!DOCTYPE html>
<html>

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="borderstyle.css">
    <title>Register Vaccine Dose</title>
</head>

<body>
<header>
    <div class= "topheader">
    <a id = "GFG" class="vaccimateLogo" href = "http://localhost/Page_layout_Caregiver.php"> &#128137 VacciMate </a> 
    <div class= "rightpart_topheader">
     <a id = "GFG" href = "<?php echo $my_page_caregiver; ?>" class="costumbutton1"> My Pages </a>
     <a id = "GFG" href = "<?php echo $logout; ?>"  class="costumbutton1"> Logout </a>
     <a id = "GFG" href = "http://localhost:8888/frontend/Settings/Settings_Page.php" class="costumbutton1"> &#9881 </a> 
    </div>
  </div>
        </div>

        <div class="bottomheader">
            <a id="GFG" href="../../homepage/frontpage.php" class="costumbutton2"> Home </a>
            <a id="GFG" href="register_vaccine.php" class="costumbutton2"> Register Vaccine Dose </a>
            <a id="GFG" href="http://localhost:8888/processing/search_vaccine.php" class="costumbutton2"> Administration
                History
            </a>
            <a id="GFG" href="../../About_Us/About_Us.php" class="costumbutton2"> About Us </a>
        </div>
    </header>

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
            adminDoseItem += '<h4> Dose ID' + '&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp'+ 'Vaccine' + '&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ' + 'Dose number' + '&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp' + ' Administration date' + '</h4>';
            adminDoseItem += '<p>' +  administered_dose['DoseID'] + ' &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp'+ administered_dose['VaccineName'] + '&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp' + administered_dose['DoseNumber'] + '  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp' + administered_dose['AdminDate'] + '</p>';
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

</body>