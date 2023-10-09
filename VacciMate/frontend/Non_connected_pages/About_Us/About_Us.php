
<!DOCTYPE html>
<html>
<?php
  include('../../links.php');
?>

<head>
  <link rel="stylesheet" type="text/css" href="../../borderstyle.css">
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



 <body>
 <h1> About us </h1>
 <div class = "bodydiv">
   <div class = "newscolumns_Wide">
     <h2> Our Goal </h2>
     <p> Our motivation is to improve world health one vaccine dose at the time. By offering easy access to all your vaccine history and sending reminders on upcoming doses we want to minimize unnessisarry sickness due to forgotten vaccine doses. At the same time we want to make sure your money and time will not be spend on taking a vaccine twice when its not needed, you can easyly check your what vaccines you have already taken when logged in. </p>
     <img src="https://live.staticflickr.com/784/40450902634_4f1de0dd24_b.jpg" alt="test_pic">
   </div>
   <div class = "newscolumns">
     <h2> Contact Us </h2>
     <p> Email: www.VacciMate.se </p>
     <p> Phone: 070 000 00 00 </p>
     <h2>Privacy Policy</h2>
     <p>To learn more about how we handle your data, please read our
     <a class="privacy-policy-link" href="privacy_policy.php"style="color: black; font-weight: bold; text-decoration: none;">Privacy Policy</a>.</p>
   </div>
  </div>
  
 </body>

</body>
</html>