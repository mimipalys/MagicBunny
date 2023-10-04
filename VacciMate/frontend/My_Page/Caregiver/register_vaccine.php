<?php
// Frontend for viewing your vaccine history
// display  vaccine doses and refills when that button is pressed, display schedules when that button is pressed
// have if-statement to check
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

error_reporting(E_ALL);
ini_set('display_errors', 1);
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

        <div class="bottomheader">
            <a id="GFG" href="../../homepage/frontpage.php" class="costumbutton2"> Home </a>
            <a id="GFG" href="register_vaccine.php" class="costumbutton2"> Register Vaccine Dose </a>
            <a id="GFG" href="view_administered_vaccines.php" class="costumbutton2"> Administration
                History
            </a>
            <a id="GFG" href="../../About_Us/About_Us.php" class="costumbutton2"> About Us </a>
        </div>
    </header>

    <div class="registervaccinecontainer">
        <h1 class="register-vaccine-title">Register Vaccine Dose</h1>
        <form action="../../../processing/insert_vaccine.php" method="post">
            <label class="register-vaccine-label" for="patientID">Patient ID:</label>
            <input class="register-vaccine-input" type="text" id="patientID" name="patientID" required>

            <label class="register-vaccine-label" for="healthcareProviderID">Healthcare Provider ID:</label>
            <input class="register-vaccine-input" type="text" value="<?php echo $caregiverID; ?>" id="healthcareProviderID" name="healthcareProviderID" readonly>
            <!-- make into searchable dropdown menu -->
            <label class="register-vaccine-label" for="doseID">Dose ID:</label>
            <input class="register-vaccine-input" type="text" id="doseID" name="doseID" required>

            <label class="register-vaccine-label" for="vaccine">Vaccine:</label>
            <input class="register-vaccine-input" type="text" id="vaccine" name="vaccine" required>
            <div id="suggestions"></div>

            <label class="register-vaccine-label" for="doseNumber">Dose Number:</label>
            <input class="register-vaccine-input" type="text" id="doseNumber" name="doseNumber" required>

            <label class="register-vaccine-label" for="administrationDate">Administration Date:</label>
            <input class="register-vaccine-input" type="date" id="administrationDate" name="administrationDate"
                required>

            <button class="register-vaccine-button" type="submit">Register Dose</button>
        </form>

        <script>
const vaccineNameInput = document.getElementById('vaccine');
const suggestionsDiv = document.getElementById('suggestions');

vaccineNameInput.addEventListener('input', function() {
    const input = vaccineNameInput.value;
    console.log('Input Value:', input); // Log the input value to the console

    // Make an AJAX request to the server-side script
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `../../../processing/get_vaccines_for_live_search_form.php?input=${input}`, true);
    
    xhr.onload = function() {
        console.log('Response from Server:', xhr.responseText); // Log the server response
        const response = JSON.parse(xhr.responseText);
        displaySuggestions(response);
    };
    
    xhr.send();
});

function displaySuggestions(suggestions) {
    // Clear previous suggestions
    suggestionsDiv.innerHTML = '';
    
    // Log the suggestions array
    console.log('Suggestions from Server:', suggestions);

    // Display new suggestions
    suggestions.forEach(function(suggestion) {
        const suggestionDiv = document.createElement('div');
        suggestionDiv.textContent = suggestion;
        suggestionDiv.addEventListener('click', function() {
            // Set the selected suggestion as the input value
            vaccineNameInput.value = suggestion;
            // Clear the suggestions
            suggestionsDiv.innerHTML = '';
        });
        suggestionsDiv.appendChild(suggestionDiv);
    });
}


        </script>

    </div>

</body>

</html>
