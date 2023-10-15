<?php
// Frontend for viewing your vaccine history
// display  vaccine doses and refills when that button is pressed, display schedules when that button is pressed
// have if-statement to check
session_start();
include('../../links.php');

$caregiverID = $_SESSION['user_id'];

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
    <!-- <link rel="stylesheet" type="text/css" href="mypages_caregiver.css"> -->
    <link rel="stylesheet" type="text/css" href="../../borderstyle.css">
    <title>Register Vaccine Dose</title>
</head>

<?php include $header_my_page_caregiver; ?>

<main>

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
</main>

</body>


</html>

<?php
include $footer;
?>
