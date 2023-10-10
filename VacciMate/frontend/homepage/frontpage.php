<!DOCTYPE html>
<html>

<?php include('../links.php'); ?>
<head>
  <link rel="stylesheet" type="text/css" href="<?php echo $styles_doc ?>">

  <title>
          Using display: flex and 
          justify-content: space-between
  </title>
</head>

<?php 
session_start();

//include correct header
if (isset($_SESSION['user_id']) and $_SESSION['role'] == "patient") {
  include $header_logged_in_patient;
} elseif (isset($_SESSION['user_id']) and $_SESSION['role'] == "caregiver") {
  include $header_logged_in_caregiver;
} else {
  include $header;
}




?>

<main>
 <div class="bodydiv">
    <?php
    echo '<a id="GFG" href="' . $TBE_link . '" class="newscolumns">
   
    <h2>Did you remember to take your refill dose of the TBE vaccine?</h2>
    <p>Read everything about the TBE vaccine here and stay safe during the hot summer months</p>
    <img src="' . $TBE_image . '" alt="test_pic"> </a>';
    ?>
    <?php
    echo '<a id="GFG" href="' . $influenza_link . '" class="newscolumns">
   
    <h2>Revolutionizing Healthcare: A Breakthrough Journey in Influenza Vaccine Development</h2>
    <p>Explore the future of immunity: Unraveling groundbreaking advancements in our latest influenza vaccine research..</p>
    <img src="' . $influenza_image . '" alt="test_pic"> </a>';
    ?>
   
  
   <?php
    echo '<a id="GFG" href="' . $kenya_link . '" class="newscolumns">
    <h2>Traveling to Kenya? Stay Informed!</h2>
    <p>Get all the information you need about vaccines needed in the area!</p>
    <img src="' . $kenya_image . '" alt="test_pic"> </a>';
    ?>
  </div>

 </main>

      <!-- Cookie popup  -->
    <div id="cookiePopup" style="display: none; position: fixed; bottom: 0; left: 0; right: 0; background-color: #666666; color: white; text-align: center; padding: 10px;">
        <p>We use cookies to improve your browsing experience. Click "Accept" to agree.</p>
        <button id="acceptCookieButton">Accept</button>
    </div>

    <script>
        // JavaScript code to display the popup and handle user consent
        document.addEventListener("DOMContentLoaded", function () {
            var cookiePopup = document.getElementById("cookiePopup");
            var acceptCookieButton = document.getElementById("acceptCookieButton");

            // Check if cookies have already been accepted
            var hasAcceptedCookie = localStorage.getItem("cookieAccepted");

            // If cookies have not been accepted yet, display the popup
            if (!hasAcceptedCookie) {
                cookiePopup.style.display = "block";
            }

            // Handle user click on the Accept button
            acceptCookieButton.addEventListener("click", function () {
                // Hide the popup
                cookiePopup.style.display = "none";

                // Record user consent in local storage
                localStorage.setItem("cookieAccepted", "true");
            });
        });
    </script>
 </body>

 <?php 
 include $footer;
 ?>
</html>