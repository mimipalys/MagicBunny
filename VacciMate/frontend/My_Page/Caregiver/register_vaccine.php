<?php
// Frontend for viewing your vaccine history
// display  vaccine doses and refills when that button is pressed, display schedules when that button is pressed
// have if-statement to check
session_start();
echo "frontend: ";
echo $_SESSION['user_id'];
echo $_SERVER["DOCUMENT_ROOT"];

$caregiverID = $_SESSION['user_id'];

?>



<!DOCTYPE html>
<html>

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../../borderstyle.css">
    <title>Register Vaccine Dose</title>
</head>

<body>
    <header>
        <div class="topheader">
            <a class="vaccimateLogo"> &#128137 VacciMate </a>
            <div class="rightpart_topheader">
                <a id="GFG" href="../../../processing/logout.php" class="costumbutton1"> Logout </a>
                <button id="GFG" href="http://localhost:8888/processing/index.php" class="costumbutton1"> My Pages
                </button>
                <button id="GFG" href="http://localhost:8888/processing/index.php" class="costumbutton1"> &#9881
                </button>
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

    <div class="registervaccinecontainer">
        <h1 class="register-vaccine-title">Register Vaccine Dose</h1>
        <form action="submit_vaccine_dose.php" method="post">
            <label class="register-vaccine-label" for="patientID">Patient ID:</label>
            <input class="register-vaccine-input" type="text" id="patientID" name="patientID" required>

            <label class="register-vaccine-label" for="healthcareProviderID">Healthcare Provider ID:</label>
            <input class="register-vaccine-input" type="text" value="<?php echo $caregiverID; ?>" id="healthcareProviderID" name="healthcareProviderID" readonly>
            <!-- make into searchable dropdown menu -->
            <label class="register-vaccine-label" for="vaccine">Vaccine:</label>
            <input class="register-vaccine-input" type="text" id="vaccine" name="vaccine" required>
            
            <label class="register-vaccine-label" for="doseNumber">Dose Number:</label>
            <input class="register-vaccine-input" type="text" id="doseNumber" name="doseNumber" required>

            <label class="register-vaccine-label" for="administrationDate">Administration Date:</label>
            <input class="register-vaccine-input" type="date" id="administrationDate" name="administrationDate"
                required>

            <button class="register-vaccine-button" type="submit">Register Dose</button>
        </form>
    </div>

</body>

</html>
