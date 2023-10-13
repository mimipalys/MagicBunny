<!DOCTYPE html>
<html>

<?php include('../links.php'); ?>
<head>
  <link rel="stylesheet" type="text/css" href="../borderstyle.css">

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
     <section>
    <?php
    echo '
    <img src="' . $TBE_image . '" alt="test_pic"> 
    <h3>Did you remember to take your refill dose of the TBE vaccine?</h3>
    <p>Have you taken a moment to check if you\'ve had your refill dose of the Tick-Borne Encephalitis (TBE) vaccine? It\'s a crucial step towards safeguarding your health, particularly during the warm summer months when ticks are more active. Understanding the importance of the TBE vaccine is key to protecting yourself from this potentially serious disease. Take the time to educate yourself about the TBE vaccine - its benefits, recommended dosages, and any potential side effects. By staying informed, you\'re not only looking out for your own well-being but also contributing to the overall safety of your community. Make sure you\'re armed with the knowledge and protection you need to enjoy a worry-free summer season.</p>
    <a  href="' . $TBE_link . '">Click here for more info</a> ';
    ?>
     </section>

     <section>
    <?php
    echo '
    <img src="' . $influenza_image . '" alt="test_pic">
    <h3>Revolutionizing Healthcare: A Breakthrough Journey in Influenza Vaccine Development</h3>
    <p>Embark on a transformative journey in healthcare with our groundbreaking strides in Influenza Vaccine Development. Witness a paradigm shift in immunity as we unveil the latest advancements in our research. Delving deep into the science, our dedicated team of experts is at the forefront of revolutionizing influenza prevention. This breakthrough promises not only heightened effectiveness but also a potential leap in public health outcomes. By exploring the frontiers of vaccine innovation, we aim to redefine the way we approach seasonal influenza, providing a stronger defense against this persistent global health challenge. Join us in this remarkable venture towards a healthier and more resilient future.</p>
    <a  href="' . $TBE_link . '">Click here to know more</a>
    ';
    ?>
     </section>

     <section>
   <?php
    echo '
    <img src="' . $kenya_image . '" alt="test_pic">
    <h3>Traveling to Kenya? Stay Informed!</h3>
    <p>Embarking on a journey requires meticulous planning. Prioritize essential vaccinations and guard against Malaria. Secure comprehensive travel insurance for peace of mind. Stay updated on COVID-19 guidelines and know nearby healthcare options. Exercise caution in high altitudes and stay aware of local safety. Respect customs for a richer experience. Consult professionals for the latest information. Familiarize yourself with nearby healthcare facilities; they serve as a valuable resource in case of any unexpected health concerns. If your itinerary includes high-altitude destinations, it\'s crucial to exercise caution to prevent altitude sickness. Stay attuned to local safety advisories for a secure and worry-free experience. Safe travels!</p>
    <a  href="' . $TBE_link . '">Click here to go to the travel page</a>
    ';
    ?>
     </section>
  </div>

 </main>

      <!-- Cookie popup  -->
    <div id="cookiePopup" style="display: none; position: fixed; bottom: 0; left: 0; right: 0; background-color: rgba(102,102,102,0.75); color: white; text-align: center; padding: 30px;">
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