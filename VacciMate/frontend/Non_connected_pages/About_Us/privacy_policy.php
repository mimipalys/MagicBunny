
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
 <div class = "bodydiv">
   <div class = "privacy_policy">
     <h2>Privacy policy for VacciMate visitors </h2>
     <p>VacciMate knows that personal integrity is important for our customers, parterners and website visitors. The purpose of this policy is to clearly and transparently describe how we process your personal data when visiting our website, so that you can feel secure that we handle your personal data in a legal and secure manner. We process your personal data in accordance with the EU General Data Protection Regulation (GDPR). </p>
     <h3> What data do we collect?</h3>
     <p>VacciMate collects the following data when visit our website: Personal identification information (Personal number, name, email address, phone number, address, etc.)</p>
     <h3>How do we collect your data?</h3>
     <p>You directly provide us with most of the data we collect. We collect data and process data when you:</p>
     <p>Register online or place an order for any of our products or services.</p>
     <p>Use or view our website via your browser’s cookies.</p>
     <h3>How will we use your data?</h3>
     <p>We process these data for following purpose:
      <p>Process your order and manage your account.</p>
      <p>Email you to inform the upcoming doses.</p>
     <h3>What are your data protection rights?</h3>
     <p>VacciMate would like to make sure you are fully aware of all of your data protection rights. Every user is entitled to the following:</p>
<p><strong>The right to access</strong> – You have the right to request VacciMate for copies of your personal data.<p>
<p><strong>The right to rectification</strong> – You have the right to request that VacciMate correct any information you believe is inaccurate. You also have the right to request VacciMate to complete the information you believe is incomplete.</p>
<p><strong>The right to erasure</strong> – You have the right to request that VacciMate erase your personal data.</p>
<p><strong>The right to restrict processing</strong> – You have the right to request that VacciMate restrict the processing of your personal data.</p>
<p><strong>The right to object to processing</strong> – You have the right to object to VacciMate’s processing of your personal data.</p>
<p><strong>The right to data portability</strong> – You have the right to request that VacciMate transfer the data that we have collected to another organization, or directly to you.</p>
<p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us:</p>
<p>Call us at: 070 000 00 00
<p>Email to us: vaccimate0@gmail.com
</p>
     <h3>Cookies</h3>
     <p>Cookies are text files placed on your computer to collect standard Internet log information and visitor behavior information. When you visit our websites, we may collect information from you automatically through cookies.</p>
     <h3>How do we use cookies?</h3>
     <p>VacciMate uses cookies in a range of ways to improve your experience on our website, including:</p>
     <p>Keeping you signed in</p>
     <p>Understanding how you use our website</p>
</p>
     <h3>What types of cookies do we use?</h3>
     <p>There are a number of different types of cookies, however, our website uses:</p>
Functionality – VacciMate uses these cookies so that we recognize you on our website and remember your previously selected preferences.
</p>
     <h3>Changes to our privacy policy</h3>
     <p>VacciMate keeps its privacy policy under regular review and places any updates on this web page. This privacy policy was last updated on 4 October 2023.
</p>
     <h3>How to contact us</h3>
     <p>If you have any questions about VacciMate’s privacy policy, the data we hold on you, or you would like to exercise one of your data protection rights, you are welcome to contact us</p>
     <p>Call us at: 070 000 00 00</p>
     <p>Or Email to us: vaccimate0@gmail.com</p>
   </div>
  </div>

 </body>

</body>
<?php 
 include $footer;
 ?>
</html>