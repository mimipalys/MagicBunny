
<!DOCTYPE html>
<html>
<?php
  include('../links.php');
  // Check if the user is logged in; if not, redirect to the signIn.php page
  session_start();
  echo $_SESSION['user_id'];
  
  if (isset($_SESSION['user_id'])) {
    header("Location: ../My_Page/Patient/Page_layout_Patient.php");
    exit;
}
?>

<head>

  <link rel="stylesheet" type="text/css" href="../borderstyle.css">
  <title>
          Using display: flex and 
          justify-content: space-between
  </title>
</head>

<body>
 <header>
  <div class= "topheader">
    <?php
     echo '<a id="GFG" class="vaccimateLogo" href="' . $homepage_link . '">&#128137 VacciMate</a>';
    ?>
    
    <div class= "rightpart_topheader">
    <?php
     echo '<a id="GFG" href="' . $login_link . '" class="costumbutton1">Login</a>';
     echo '<a id="GFG" href="' . $register_link . '"  class="costumbutton1">Register</a>';
     echo '<a id="GFG" href="' . $setting_link . '" class="costumbutton1">&#9881</a>';
    ?>
    </div>
  </div>
  
  <div class= "bottomheader">
  <?php
    echo '<a id="GFG" href="' . $travel_link . '" class="costumbutton2">Travel information</a>';
    echo '<a id="GFG" href="' . $search_link . '"  class="costumbutton2">Search Vaccine</a>';
    echo '<a id="GFG" href="' . $aboutUs_link . '"  class="costumbutton2">About Us</a>';
  ?>
  </div>

 </header>

 <body>
 <div class="bodydiv">
    <?php
    echo '<a id="GFG" href="' . $TBE_link . '" class="newscolumns">
   
    <h2>Did you remember to take your refill dose of the TBE vaccine?</h2>
    <p>Read everything about the TBE vaccine here and stay safe during the hot summer months</p>
    <img src="' . $TBE_image . '" alt="test_pic"> </a>';
    ?>
    <?php
    echo '<a id="GFG" href="' . $influenza_link . '" class="newscolumns">
   
    <h2>Some exiting news on the progress of the new influenza vaccine</h2>
    <p>Some cool text introduction to the subject here</p>
    <img src="' . $influenza_image . '" alt="test_pic"> </a>';
    ?>
   
  
   <?php
    echo '<a id="GFG" href="' . $kenya_link . '" class="newscolumns">
    <h2>Traveling to Kenya this winter?</h2>
    <p>Get all the information you need about vaccines needed in the area!</p>
    <img src="' . $kenya_image . '" alt="test_pic"> </a>';
    ?>
  </div>

 </body>

</body>
</html>