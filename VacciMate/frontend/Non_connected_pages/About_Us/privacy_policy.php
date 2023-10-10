
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

<body>
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
 <h1> Privacy Policy </h1>
 <div class = "bodydiv">
   <div class = "privacy_policy">
     <h3> Privacy policy for VacciMate visitors </h3>
     <p> VacciMate knows that personal integrity is important for our customers, parterners and website visitors. The purpose of this policy is to clearly and transparently describe how we process your personal data when visiting our website, so that you can feel secure that we handle your personal data in a legal and secure manner. We process your personal data in accordance with the EU General Data Protection Regulation (GDPR). </p>
     <h3> How we collect personal data from you? </h3>
     <p>We process personal data about you when visit our website. For example, your contact and identity details, such as your name, personal number, email address, phone number and address. </p>
     <h3> Purpose of the processing of your personal data </h3>
     <p> We process these data for the communication purpose, for example, to communicate with you to remind the upcoming doses.</p>
     <p>If you have questions about making a complaint regarding VacciMate's processing of your personal data or want to exercise your rights as a registered person, you are welcome to contact us at vaccimate0@gmail.com or by calling VacciMate.</p>
   </div>
  </div>

 </body>

</body>
<?php 
 include $footer;
 ?>
</html>