
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
    <a id = "GFG" href = "http://localhost:8888/frontend/About_Us/About_Us.php" class="costumbutton2"> About Us </a> 
  </div>

 </header>

 <body>

 <h1> Settings </h1>
 
 <div class = "bodydiv">
   <div class = "newscolumns">
     <h2> Notifications</h2>
     <form>
        <input type="checkbox" id="Upcoming" name="Upcoming" value="Yes">
        <label for="Upcoming"> I want to get notifications on Upcoming vaccine doses </label><br>
        <input type="checkbox" id="News" name="News" value="Yes">
        <label for="News"> I want to get notifications on vaccine associated news </label><br>
        <input type="checkbox" id="appointment" name="appointment" value="Yes">
        <label for="appointment"> I want to get reminders 1h before a booked appointment </label><br><br>
        <input type="submit" value="Save">
    </form>

    </div>

 </div>

 </body>

</body>
</html>