
<!DOCTYPE html>
<html>

<?php
  include('../links.php');
  if (!isset($_SESSION['user_id'])) {
   header("Location: $login_link?changed=1");
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
   echo '<p id = "GFG" class="costumbutton1_choosen"> &#9881 </p>';
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

 <h1> Settings </h1>
 
 <div class = "bodydiv">
   <fieldset>
   <legend>Notifications:</legend>
     
     <form action="../../processing/notification_change.php" method="POST">
        <input type="hidden" name="text_note" value="0">
        <input type="checkbox" name="text_note" value="1">
        <label for="text_note"> I want to reccive texts on upcoming vaccine doses </label><br> <br>
        <input type="hidden" name="email_note" value="0">
        <input type="checkbox" name="email_note" value="1">
        <label for="email_note"> I want to reccive emails on upcoming vaccine doses </label><br> <br>
        <input type="submit" value="Save">
    </form>
    
    
    </fieldset>
  
    <?php

   if (isset($_GET['changed'])) {
    echo "Notification settings changed!";
}
  ?>
  </div>

 </div>

 </body>

</body>
</html>
