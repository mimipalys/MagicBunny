
<!DOCTYPE html>
<html>

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
    <a id = "GFG" class="vaccimateLogo" href = "http://localhost:8888/frontend/homepage/frontpage.php"> &#128137 VacciMate </a> 
    <div class= "rightpart_topheader">
     <a id = "GFG" href = "http://localhost:8888/processing/index.php" class="costumbutton1"> Login </a> 
     <a id = "GFG" href = "http://localhost:8888/processing/index.php" class="costumbutton1"> Register </a> 
     <p id = "GFG" class="costumbutton1_choosen"> &#9881 </p>
    </div>
  </div>

  <div class= "bottomheader">
    <a id = "GFG" href = "http://localhost:8888/processing/index.php" class="costumbutton2"> Travel information </a> 
    <a id = "GFG" href = "http://localhost:8888/processing/search_vaccine.php" class="costumbutton2"> Search Vaccine </a> 
    <a id = "GFG" href = "http://localhost:8888/frontend/Non_connected_pages/About_Us/About_Us.php" class="costumbutton2"> About Us </a> 
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
