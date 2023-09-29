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




